<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\RequestForm;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rows = $user->tasks()->latest()->paginate(20);
        return view('request.task.index', compact('rows'));
    }

    public function create()
    {
        $task = new Task();
        $forms = RequestForm::query()->pluck('title','id')->toArray();
        $form_action =[
            'url'=> route('tasks.store'),
            'method'=> 'POST',
        ];
        return view('request.task.form',compact('task','form_action','forms'));
    }

    public function store(TaskRequest $request)
    {
        dd($request->all());
        $form = RequestForm::findOrfail($request->request_form_id);
        $elements = $form->elements()->pluck('id')->toArray();
        $values = serialize($request->only($elements));

        Task::create([
            'request_form_id'=>$request->request_form_id,
            'values'=>$values,
            'user_id'=>auth()->id(),
        ]);

        return redirect('/admin/request/tasks')->with('status',' Added Successfully');

    }


    public function edit(Task $task)
    {
        $form = $task->form;
        $elements = $form->elements;
        $form_action =[
            'url'=> route('tasks.update',$task->id),
            'method'=> 'PATCH',
        ];
        return view('request.task.form', compact('task','form_action','elements'));
    }


    public function update(TaskRequest $request, Task $task)
    {
        $form = $task->form;
        $elements = $form->elements()->pluck('id')->toArray();
        $values = serialize($request->only($elements));
        $task->update(['values'=>$values,]);
        return redirect('/admin/request/tasks')->with('edit', $task->title);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/admin/request/tasks');
    }

    public function changeForm(Request $request)
    {
        $form = RequestForm::findOrfail($request->request_form_id);
        $elements = $form->elements;
        $task = new Task;
        return view('request.task.elements',compact('elements','task'))->render();
    }
}
