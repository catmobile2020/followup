<?php

namespace App\Http\Controllers;

use App\Corporate;
use Illuminate\Http\Request;

class CorporateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corporate = Corporate::find(1);
        return view('corporate.create', compact('corporate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'about'=>'required',
            'mission'=>'required',
            'vision'=>'required',
        ]);
        $corporate = Corporate::find(1);
        $corporate->about = $request->about;
        $corporate->mission = $request->mission;
        $corporate->vision = $request->vision;

        $corporate->save();
        return redirect()->back()->with('status', 'Corporate Module');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Corporate  $corporate
     * @return \Illuminate\Http\Response
     */
    public function show(Corporate $corporate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Corporate  $corporate
     * @return \Illuminate\Http\Response
     */
    public function edit(Corporate $corporate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corporate  $corporate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corporate $corporate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Corporate  $corporate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corporate $corporate)
    {
        //
    }
}
