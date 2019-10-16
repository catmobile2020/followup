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

    public function index(Request $request)
    {
        $user =User::find($request->user_id);
        $rows = $user->vacations()->get();
        return $this->showAll($rows,200);
    }

    public function store(VacationRequest $request)
    {
        $user =User::find($request->user_id);
        $vacation = $user->vacations()->create($request->all());
        return $this->showOne($vacation);
    }

    public function hr()
    {
        $rows =Vacation::latest()->get();
        return $this->showAll($rows,200);
    }

    public function managerChangeStatus(Request $request,Vacation  $vacation)
    {
        $vacation->update(['active'=>$request->active]);
        return $this->showOne($vacation);
    }

    public function HrChangeStatus(Request $request,Vacation  $vacation)
    {
        $vacation->update(['hr_active'=>$request->hr_active]);
        return $this->showOne($vacation);
    }
}
