<?php

namespace App\Http\Controllers;

use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::all();
        foreach ($skills as $skill){
            if($skill->created_by > 0) {
                $username = User::findOrFail($skill->created_by);
                $skill->created_by = $username->name;
            }
        }

        return view('skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('skills.create');
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
            'name'=>'required|string|min:2|unique:skills,name',
        ]);

        Skill::create(['name'=>$request->name, 'description'=>$request->description, 'created_by'=>Auth::user()->id]);
        return redirect('/admin/skill')->with('status', $request->name.' Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return view('skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $this->validate($request, [
            'name'=>'required|unique:skills,name,'.$skill->id,
        ]);
        if($request->active == 'on'){$request->active = 1;}else{$request->active = 0;}
        $skill->name = $request->name;
        $skill->description = $request->description;
        $skill->active = $request->active;

        $skill->save();

        return redirect('/admin/skill/')->with('edit', $skill->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
