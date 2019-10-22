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

    public function index(Request $request)
    {
        $user_team = User::findOrfail($request->user_id)->team;
        $rows = $user_team->requestsForm;
        return $this->showAll($rows,200);
    }

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
