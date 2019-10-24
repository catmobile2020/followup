<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\RequestForm;
use App\Task;
use App\Team;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rows = $user->tasks()->latest()->paginate(20);
        return view('request.task.index', compact('rows'));
    }

    public function userRequests()
    {
        $user_team = auth()->user()->team;
        $rows = $user_team->usersRequests()->latest()->paginate(20);
        return view('request.task.user-requests', compact('rows'));
    }

    public function accountsReviews(Request $request)
    {
        if ($request->ajax())
        {
            $task = Task::findOrFail($request->id);
            $task->update(['active'=>$request->active]);
            return $request->active;
        }
        $user = auth()->user();
        if($user->role->name == 'Admin' && $user->team->name == 'Accounts')
        {
            $rows = Task::latest()->paginate(20);
            return view('request.task.user-requests', compact('rows'));
        }
        return abort(401);
    }

    public function create()
    {
        $task = new Task();
        $departments = Team::all();
        $form_action =[
            'url'=> route('tasks.store'),
            'method'=> 'POST',
        ];
        return view('request.task.form',compact('task','form_action','departments'));
    }

    public function store(TaskRequest $request)
    {
        $form = RequestForm::findOrfail($request->request_form_id);
        if (!count($form->elements))
            return redirect()->back()->with('status',' Form Not Have Elements');
        $elements = $form->elements()->pluck('id')->toArray();
        $values = serialize($request->only($elements));

        Task::create([
            'request_form_id'=>$request->request_form_id,
            'values'=>$values,
            'user_id'=>auth()->id(),
            'po'=>$request->po,
        ]);

        return redirect('/admin/request/tasks')->with('status',' Added Successfully');

    }


    public function edit(Task $task)
    {
        $form = $task->form;
        $elements = $form->elements;
        $departments = Team::all();
        $form_action =[
            'url'=> route('tasks.update',$task->id),
            'method'=> 'PATCH',
        ];
        return view('request.task.form', compact('task','form_action','elements','departments'));
    }


    public function update(TaskRequest $request, Task $task)
    {
        $form = $task->form;
        $elements = $form->elements()->pluck('id')->toArray();
        $values = serialize($request->only($elements));
        $task->update(['values'=>$values,'po'=>$request->po]);
        return redirect('/admin/request/tasks')->with('edit', $task->title);
    }

//    public function destroy(Task $task)
//    {
//        $task->delete();
//        return redirect('/admin/request/tasks');
//    }

    public function changeForm(Request $request)
    {
        if ($request->type == 'form')
        {
            $form = RequestForm::findOrfail($request->id);
            $elements = $form->elements;
            $task = new Task;
            return view('request.task.elements',compact('elements','task'))->render();
        }
        $team = Team::findOrfail($request->id);
        $forms = $team->requestsForm()->pluck('title','id')->toArray();;
        return view('request.task.request-forms',compact('forms'))->render();
    }
}
