<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        foreach ($roles as $role){
            if($role->created_by > 0) {
                $username = User::findOrFail($role->created_by);
                $role->created_by = $username->name;
            }
        }

        return view('roles.index', compact('roles'));
    }

    /**
     * Display a listing of the resource.
     * @param $departmrnt
     * @return \Illuminate\Http\Response
     */

    public function teamUsers(Role $role)
    {
        $users = $role->users;
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'name'=>'string|required|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::user()->id
        ]);


        return redirect('/admin/role/')->with('status', $role->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name'=>'required|unique:roles,name,'.$role->id,
            'description'=>'required',
        ]);
        if($request->active == 'on'){$request->active = 1;}else{$request->active = 0;}
        $role->name = $request->name;
        $role->description = $request->description;
        $role->active = $request->active;

        $role->save();

        return redirect('/admin/role/')->with('edit', $role->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
