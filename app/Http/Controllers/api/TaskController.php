<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Api\TaskRequest;
use App\RequestForm;
use App\Task;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    use ApiResponser;

    public function index(Request $request)
    {
        $user = User::findOrfail($request->user_id);
        $rows = $user->tasks()->latest()->get();
        return $this->showAll($rows,200);
    }

    public function userRequests(Request $request)
    {
        $user_team = User::findOrfail($request->user_id)->team;
        $rows = $user_team->usersRequests()->latest()->get();
        return $this->showAll($rows,200);
    }

    public function accountsReviews(Request $request)
    {
        $user = User::findOrfail($request->user_id);
        if($user->role->name == 'Admin' && $user->team->name == 'Accounts')
        {
            $rows = Task::latest()->paginate(20);
            return $this->showAll($rows,200);
        }
        return abort(401);
    }

    public function changeStatus(Task $task,Request $request)
    {
        $task->update(['active'=>$request->active]);
        return $this->showOne($task);
    }

    public function store(TaskRequest $request)
    {
        $form = RequestForm::findOrfail($request->request_form_id);
        $elements = $form->elements()->pluck('id')->toArray();
        $values = serialize($request->only($elements));

        $task =Task::create([
            'request_form_id'=>$request->request_form_id,
            'values'=>$values,
            'user_id'=>auth()->id(),
        ]);

        return $this->showOne($task);

    }

    public function update(TaskRequest $request, Task $task)
    {
        $form = $task->form;
        $elements = $form->elements()->pluck('id')->toArray();
        $values = serialize($request->only($elements));
        $task->update(['values'=>$values,]);
        return $this->showOne($form);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null,204);
    }
}
