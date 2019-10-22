<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestFormRequest;
use App\RequestForm;
use App\Team;
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
        $departments = Team::all();
        return view('request.form.form',compact('form','form_action','departments'));
    }

    public function store(RequestFormRequest $request)
    {
        if ($request->has('team_id'))
        {
            $user_team = Team::findOrfail($request->team_id);
        }else
        {
            $user_team = auth()->user()->team;
        }
        $user_team->requestsForm()->create($request->all());

        return redirect('/admin/request/forms')->with('status', $request->title.' Added Successfully');

    }


    public function edit(RequestForm $form)
    {
        $form_action =[
            'url'=> route('forms.update',$form->id),
            'method'=> 'PATCH',
        ];
        $departments = Team::all();
        return view('request.form.form', compact('form','form_action','departments'));
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
