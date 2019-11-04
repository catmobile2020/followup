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

    /**
     *
     * @SWG\Get(
     *      tags={"request tasks"},
     *      path="/request/tasks",
     *      summary="Get all tasks",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = User::findOrfail($request->user_id);
        $rows = $user->tasks()->latest()->get();
        return $this->showAll($rows,200);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"request tasks"},
     *      path="/tasks/user/requests",
     *      summary="Get user tasks",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userRequests(Request $request)
    {
        $user_team = User::findOrfail($request->user_id)->team;
        $rows = $user_team->usersRequests()->latest()->get();
        return $this->showAll($rows,200);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"request tasks"},
     *      path="/tasks/accounts/reviews",
     *      summary="Get accounts tasks reviews",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     *
     * @SWG\Post(
     *      tags={"request tasks"},
     *      path="/tasks/accounts/{task}/change-status",
     *      summary="account task change status",
     *      @SWG\Parameter(
     *         name="task",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="active",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Task $task
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Task $task,Request $request)
    {
        $task->update(['active'=>$request->active]);
        return $this->showOne($task);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"request tasks"},
     *      path="/request/tasks",
     *      summary="Add New task",
     *     @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="po",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="request_form_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Task $task
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TaskRequest $request)
    {
        $form = RequestForm::findOrfail($request->request_form_id);
        if (!count($form->elements))
            return response()->json(['data'=>'Form Not Have Elements'],200);
        $elements = $form->elements()->pluck('id')->toArray();
        $values = serialize($request->only($elements));

        $task =Task::create([
            'request_form_id'=>$request->request_form_id,
            'values'=>$values,
            'user_id'=>auth()->id(),
            'po'=>$request->po,
        ]);

        return $this->showOne($task);

    }

    /**
     *
     * @SWG\Post(
     *      tags={"request tasks"},
     *      path="/request/tasks/{task}/update",
     *      summary="update task",
     *     @SWG\Parameter(
     *         name="task",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="po",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="request_form_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Task $task
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TaskRequest $request, Task $task)
    {
        $form = $task->form;
        $elements = $form->elements()->pluck('id')->toArray();
        $values = serialize($request->only($elements));
        $task->update(['values'=>$values,'po'=>$request->po]);
        return $this->showOne($form);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"request tasks"},
     *      path="/request/tasks/{task}/destroy",
     *      summary="update task",
     *     @SWG\Parameter(
     *         name="task",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null,204);
    }
}
