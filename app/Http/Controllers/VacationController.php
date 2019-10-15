<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationRequest;
use App\Vacation;
use Illuminate\Http\Request;

class VacationController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1,6',['except'=>['index','create','store']]);
    }

    public function index()
    {
        $rows = auth()->user()->vacations()->paginate(20);
        return view('vacation.index', compact('rows'));
    }

    public function create()
    {
        $vacation = new Vacation();
        $form_action =[
            'url'=> route('vacations.store'),
            'method'=> 'POST',
        ];
        return view('vacation.form',compact('vacation','form_action'));
    }

    public function store(VacationRequest $request)
    {
//        dd($request->all());
        auth()->user()->vacations()->create($request->all());

        return redirect('/admin/vacations')->with('status', $request->reason.' Added Successfully');

    }

    public function hr(Request $request)
    {
        if ($request->ajax())
        {
            $vacation = Vacation::find($request->id);
            $vacation->update(['active'=>$request->active]);
            return $vacation->active;
        }
        $rows =Vacation::latest()->paginate(20);
        return view('vacation.hr.index', compact('rows'));
    }

//    public function edit(Vacation $vacation)
//    {
//        $form_action =[
//            'url'=> route('vacations.update',$vacation->id),
//            'method'=> 'PATCH',
//        ];
//        return view('vacation.form', compact('vacation','form_action'));
//    }
//
//
//    public function update(VacationRequest $request, Vacation $vacation)
//    {
//        $vacation->update($request->all());
//        return redirect('/admin/vacations')->with('edit', $vacation->reason);
//    }
}
