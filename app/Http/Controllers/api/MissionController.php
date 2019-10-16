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

    public function index(Request $request)
    {
        $user =User::find($request->user_id);
        $rows = $user->missions()->get();
        return $this->showAll($rows,200);
    }

    public function store(MissionRequest $request)
    {
        $user =User::find($request->user_id);
        $vacation = $user->missions()->create($request->all());
        return $this->showOne($vacation);
    }

    public function hr(Request $request)
    {
        $rows =Mission::latest()->get();
        return $this->showAll($rows,200);
    }

    public function managerChangeStatus(Request $request,Mission $mission)
    {
        $mission->update(['active'=>$request->active]);
        return $this->showOne($mission);
    }

    public function HrChangeStatus(Request $request,Mission $mission)
    {
        $mission->update(['hr_active'=>$request->hr_active]);
        return $this->showOne($mission);
    }
}
