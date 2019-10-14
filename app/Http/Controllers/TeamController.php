<?php

namespace App\Http\Controllers;

use App\Skill;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();

        foreach ($teams as $team){
            if($team->created_by > 0) {
                $username = User::findOrFail($team->created_by);
                $team->created_by = $username->name;
            }
        }

        return view('teams.index', compact('teams'));
    }

    /**
     * Display a listing of the resource.
     * @param $departmrnt
     * @return \Illuminate\Http\Response
     */

    public function teamUsers(Team $team)
    {
        $users = $team->users;
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skills = Skill::all();
        return view('teams.create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'string|required|unique:teams,name',
        ]);

        $team = Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::user()->id
        ]);

        $team->skills()->attach($request->skills);

        return redirect('/admin/department/')->with('status', $team->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($department)
    {
        $team = Team::findOrFail($department);
        $skills = Skill::where('active',1)->get();
        return view('teams.edit', compact('team', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $department)
    {
        $team = Team::findOrFail($department);
        $this->validate($request, [
            'name'=>'required|unique:teams,name,'.$team->id,
            'description'=>'required',
        ]);
        if($request->active == 'on'){$request->active = 1;}else{$request->active = 0;}
        $team->name = $request->name;
        $team->description = $request->description;
        $team->active = $request->active;

        $team->save();
        $team->skills()->sync($request->skills);

        return redirect('/admin/department/')->with('edit', $team->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
