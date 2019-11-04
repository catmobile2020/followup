<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Api\RequestFormRequest;
use App\RequestForm;
use App\Team;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestFormController extends Controller
{
    use ApiResponser;

    /**
     *
     * @SWG\Get(
     *      tags={"requests forms"},
     *      path="/requests/forms",
     *      summary="Get All Forms",
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
        $user_team = User::findOrfail($request->user_id)->team;
        $rows = $user_team->requestsForm;
        return $this->showAll($rows,200);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"requests forms"},
     *      path="/requests/forms",
     *      summary="add New form",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="title",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="team_id",
     *         in="formData",
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param RequestFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RequestFormRequest $request)
    {
        if ($request->has('team_id'))
        {
            $user_team = Team::findOrfail($request->team_id);
        }else
        {
            $user_team = User::findOrfail($request->user_id)->team;
        }
        $form =$user_team->requestsForm()->create($request->all());

        return $this->showOne($form);

    }

    /**
     *
     * @SWG\Post(
     *      tags={"requests forms"},
     *      path="/requests/forms/{form}/update",
     *      summary="add update form",
     *      @SWG\Parameter(
     *         name="form",
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
     *         name="title",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param RequestFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RequestFormRequest $request, RequestForm $form)
    {
        $form->update($request->all());
        return $this->showOne($form);
    }
//
//    public function destroy(RequestForm $form)
//    {
//        $form->delete();
//        return response()->json(null,204);
//    }
}
