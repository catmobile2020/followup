<?php

namespace App\Http\Controllers;


use App\Http\Requests\MissionRequest;
use App\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
//    public function __construct()
//    {
//        $team_id = auth()->user()->team->id;
//        $this->middleware("role:1,{$team_id}",['except'=>['index','create','store']]);
//    }

    public function index()
    {
        $rows = auth()->user()->missions()->latest()->paginate(20);
        return view('mission.index', compact('rows'));
    }

    public function create()
    {
        $mission = new Mission();
        $form_action =[
            'url'=> route('missions.store'),
            'method'=> 'POST',
        ];
        return view('mission.form',compact('mission','form_action'));
    }

    public function store(MissionRequest $request)
    {
//        dd($request->all());
        auth()->user()->missions()->create($request->all());

        return redirect('/admin/missions')->with('status', $request->reason.' Added Successfully');

    }

    public function hr(Request $request)
    {
        if ($request->ajax())
        {
            $mission = Mission::find($request->id);
            $mission->update([$request->name=>$request->active]);
            return $mission->active;
        }
        $rows =Mission::latest()->paginate(20);
        return view('mission.hr.index', compact('rows'));
    }

//    public function edit(Mission $mission)
//    {
//        $form_action =[
//            'url'=> route('missions.update',$mission->id),
//            'method'=> 'PATCH',
//        ];
//        return view('mission.form', compact('mission','form_action'));
//    }
//
//
//    public function update(MissionRequest $request, Mission $mission)
//    {
//        $mission->update($request->all());
//        return redirect('/admin/missions')->with('edit', $mission->reason);
//    }
}
