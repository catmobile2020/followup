<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Api\MissionRequest;
use App\Mission;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissionController extends Controller
{
    use ApiResponser;

    /**
     *
     * @SWG\Get(
     *      tags={"missions"},
     *      path="/missions",
     *      summary="Get all missions",
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
        $user =User::find($request->user_id);
        $rows = $user->missions()->get();
        return $this->showAll($rows,200);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"missions"},
     *      path="/missions",
     *      summary="add New mission",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="reason",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
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
     *      ),@SWG\Parameter(
     *         name="type",
     *         in="formData",
     *         required=true,
     *         description="type(morning,evening,all_day)]",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param MissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MissionRequest $request)
    {
        $user =User::find($request->user_id);
        $vacation = $user->missions()->create($request->all());
        return $this->showOne($vacation);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"missions"},
     *      path="users/missions/hr",
     *      summary="HR Get All Members missions ",
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function hr(Request $request)
    {
        $rows =Mission::latest()->get();
        return $this->showAll($rows,200);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"missions"},
     *      path="/users/missions/manager-change-status/{mission}",
     *      summary="Team Manager Change mission Status ",
     *      @SWG\Parameter(
     *         name="mission",
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
     * @param Request $request
     * @param Mission $mission
     * @return \Illuminate\Http\JsonResponse
     */
    public function managerChangeStatus(Request $request,Mission $mission)
    {
        $mission->update(['active'=>$request->active]);
        return $this->showOne($mission);
    }

    /**
     *
     * @SWG\Get(
     *      tags={"missions"},
     *      path="/users/missions/hr-change-status/{mission}",
     *      summary="HR  Change mission Status",
     *      @SWG\Parameter(
     *         name="mission",
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
     * @param Mission $mission
     * @return \Illuminate\Http\JsonResponse
     */
    public function HrChangeStatus(Request $request,Mission $mission)
    {
        $mission->update(['hr_active'=>$request->hr_active]);
        return $this->showOne($mission);
    }
}
