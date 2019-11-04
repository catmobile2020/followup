<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Api\VacationRequest;
use App\Traits\ApiResponser;
use App\User;
use App\Vacation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VacationController extends Controller
{
    use ApiResponser;

    /**
     *
     * @SWG\Get(
     *      tags={"vacations"},
     *      path="/vacations",
     *      summary="Get all vacations",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
    public function index(Request $request)
    {
        $user =User::find($request->user_id);
        $rows = $user->vacations()->get();
        return $this->showAll($rows,200);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"vacations"},
     *      path="/vacations",
     *      summary="add New vacation",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="date_from",
     *         in="formData",
     *         required=true,
     *         description="2019-10-14",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="date_to",
     *         in="formData",
     *         required=true,
     *         description="2019-10-14",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param VacationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VacationRequest $request)
    {
        $user =User::find($request->user_id);
        $vacation = $user->vacations()->create($request->all());
        return $this->showOne($vacation);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"vacations"},
     *      path="/users/vacations/hr",
     *      summary="HR Get All Members vacation ",
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
    public function hr()
    {
        $rows =Vacation::latest()->get();
        return $this->showAll($rows,200);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"vacations"},
     *      path="/users/vacations/manager-change-status/{vacation}",
     *      summary="Team Manager Change vacation Status ",
     *      @SWG\Parameter(
     *         name="vacation",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Parameter(
     *         name="active",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
    public function managerChangeStatus(Request $request,Vacation  $vacation)
    {
        $vacation->update(['active'=>$request->active]);
        return $this->showOne($vacation);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"vacations"},
     *      path="/users/vacations/hr-change-status/{vacation}",
     *      summary="HR  Change vacation Status",
     *      @SWG\Parameter(
     *         name="vacation",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Parameter(
     *         name="hr_active",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Request $request
     * @param Vacation $vacation
     * @return \Illuminate\Http\JsonResponse
     */
    public function HrChangeStatus(Request $request,Vacation  $vacation)
    {
        $vacation->update(['hr_active'=>$request->hr_active]);
        return $this->showOne($vacation);
    }
}
