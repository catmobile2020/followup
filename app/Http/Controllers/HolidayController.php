<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\Http\Requests\HolidayRequest;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:1,6',['except'=>['index']]);
    }
    public function index()
    {
        $rows = Holiday::paginate(20);
        return view('holiday.index', compact('rows'));
    }

    public function create()
    {
        $holiday = new Holiday();
        $form_action =[
            'url'=> route('holidays.store'),
            'method'=> 'POST',
        ];
        return view('holiday.form',compact('holiday','form_action'));
    }

    public function store(HolidayRequest $request)
    {
//        dd($request->all());
         Holiday::create($request->all());

        return redirect('/admin/holidays')->with('status', $request->title.' Added Successfully');

    }


    public function edit(Holiday $holiday)
    {
        $form_action =[
            'url'=> route('holidays.update',$holiday->id),
            'method'=> 'PATCH',
        ];
        return view('holiday.form', compact('holiday','form_action'));
    }


    public function update(HolidayRequest $request, Holiday $holiday)
    {

        $holiday->update($request->all());
        return redirect('/admin/holidays')->with('edit', $holiday->title);



    }

    public function destroy(Holiday $holiday)
    {
        //
        $holiday->delete();
        return redirect('/admin/holidays');
    }
}
