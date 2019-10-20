<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestFormRequest;
use App\RequestForm;
use Illuminate\Http\Request;

class RequestFormController extends Controller
{
    public function index()
    {
        $user_team = auth()->user()->team;
        $rows = $user_team->requestsForm()->paginate(20);
        return view('request.form.index',compact('user_team','rows'));
    }

    public function create()
    {
        $form = new RequestForm();
        $form_action =[
            'url'=> route('forms.store'),
            'method'=> 'POST',
        ];
        return view('request.form.form',compact('form','form_action'));
    }

    public function store(RequestFormRequest $request)
    {
        $user_team = auth()->user()->team;
        $user_team->requestsForm()->create($request->all());

        return redirect('/admin/request/forms')->with('status', $request->title.' Added Successfully');

    }


    public function edit(RequestForm $form)
    {
        $form_action =[
            'url'=> route('forms.update',$form->id),
            'method'=> 'PATCH',
        ];
        return view('request.form.form', compact('form','form_action'));
    }


    public function update(RequestFormRequest $request, RequestForm $form)
    {

        $form->update($request->all());
        return redirect('/admin/request/forms')->with('edit', $form->title);



    }

    public function destroy(RequestForm $form)
    {
        $form->delete();
        return redirect('/admin/request/forms');
    }
}
