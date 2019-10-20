<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Api\RequestFormRequest;
use App\RequestForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestFormController extends Controller
{
    public function index()
    {
        $user_team = auth()->user()->team;
        $rows = $user_team->requestsForm()->paginate(20);
        return $this->showAll($rows,200);
    }

    public function store(RequestFormRequest $request)
    {
        $user_team = auth()->user()->team;
        $form =$user_team->requestsForm()->create($request->all());

        return $this->showOne($form);

    }

    public function update(RequestFormRequest $request, RequestForm $form)
    {
        $form->update($request->all());
        return $this->showOne($form);



    }

    public function destroy(RequestForm $form)
    {
        $form->delete();
        return response()->json(null,204);
    }
}
