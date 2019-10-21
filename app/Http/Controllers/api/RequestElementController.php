<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Api\RequestElementRequest;
use App\RequestElement;
use App\RequestForm;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestElementController extends Controller
{
    use ApiResponser;

    public function index(RequestForm $form)
    {
        $rows = $form->elements;
        return $this->showAll($rows,200);
    }

    public function store(RequestForm $form,RequestElementRequest $request)
    {
        $element =$form->elements()->create($request->all());
        return $this->showOne($element);
    }

    public function update(RequestForm $form,RequestElementRequest $request, RequestElement $element)
    {
        $element->update($request->all());
        return $this->showOne($element);
    }

    public function destroy(RequestForm $form,RequestElement $element)
    {
        $element->delete();
        return response()->json(null,204);
    }
}
