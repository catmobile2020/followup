<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestElementRequest;
use App\RequestElement;
use App\RequestForm;
use Illuminate\Http\Request;

class RequestElementController extends Controller
{
    public function index(RequestForm $form)
    {
        $rows = $form->elements()->paginate(20);
        return view('request.element.index',compact('form','rows'));
    }

    public function create(RequestForm $form)
    {
        $element = new RequestElement();
        $form_action =[
            'url'=> route('elements.store',$form->id),
            'method'=> 'POST',
        ];
        return view('request.element.form',compact('element','form_action'));
    }

    public function store(RequestForm $form,RequestElementRequest $request)
    {
        $form->elements()->create($request->all());

        return redirect()->route('elements.index',$form->id)->with('status', $request->title.' Added Successfully');

    }


    public function edit(RequestForm $form,RequestElement $element)
    {
        $form_action =[
            'url'=> route('elements.update',[$form->id,$element->id]),
            'method'=> 'PATCH',
        ];
        return view('request.element.form', compact('element','form_action'));
    }


    public function update(RequestForm $form,RequestElementRequest $request, RequestElement $element)
    {

        $element->update($request->all());
        return redirect()->route('elements.index',$form->id)->with('edit', $element->title);



    }

    public function destroy(RequestForm $form,RequestElement $element)
    {
        $element->delete();
        return redirect()->route('elements.index',$form->id);
    }
}
