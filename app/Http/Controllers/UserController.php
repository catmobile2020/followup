<?php

namespace App\Http\Controllers;

use App\Group;
use App\Mail\UserActivate;
use App\Mail\UserDeactivate;
use App\Role;
use App\Skill;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chat()
    {
        return view('chat');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skills = Skill::where('active', 1)->get();
        $teams = Team::where('active', 1)->get();
        $roles = Role::where('active', 1)->get();
        return view('users.create', compact('skills', 'teams', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required',
            'team_id' => 'required',
        ]);


       $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'bio' => $request->bio,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'team_id' => $request->team_id,
        ]);

       $user->skills()->attach($request->skills);

        return redirect('/admin/users/')->with('status', $user->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //

        return view('users.edit', compact('user'));
    }
    
    public function change(User $user)
    {
        //
        $skills = Skill::where('active', 1)->get();
        $teams = Team::where('active', 1)->get();
        $roles = Role::where('active', 1)->get();
        return view('users.edit-user', compact('user', 'skills', 'teams', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //

        $user->name = $request->name;
        $user->phone = $request->phone;

        $user->save();

        if($request->hasFile('photo')) {
            foreach ($user->photos as $photo){
                if(file_exists($photo->path)){
                    @unlink($photo->path);
                }

            }


            $image = $request->file('photo');
            $image_filename = $user->id.$image->getClientOriginalName();
            $image->move(public_path('uploads'), $image_filename);
            if(count($user->photos) > 0){
                $user->photos()->update(['path' => 'uploads/' . $image_filename]);
            }else{
                $user->photos()->create(['path' => 'uploads/' . $image_filename]);
            }


        }

        return redirect('/admin/users/' );
    }
    
    
    public function updateUser(Request $request, User $user)
    {
        //
         $this->validate($request, [
            'name'=>'string|required',
            'phone'=>'required|numeric',
            'role_id' => 'required',
            'team_id' => 'required',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role_id = $request->role_id;
        $user->bio = $request->bio;
        $user->team_id = $request->team_id;
        $user->save();
        
        $user->skills()->sync($request->skills);

        return redirect('/admin/users/' )->with('update', $user->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Activate the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function activate(User $user)
    {
        $user->active = 1;
        $user->save();
        //dd($user);
        Mail::to($user->email)->send(new UserActivate($user));
        return redirect()->back();
    }

    public function deactivate(User $user)
    {
        $user->active = 0;
        $user->save();
        Mail::to($user->email)->send(new UserDeactivate($user));
        return redirect()->back();
    }

    public function changePassword(User $user){

        return view('users.change', compact('user'));
    }

    public function updatePassword(Request $request, User $user){
        $this->validate($request , [
            'oldPassword' => 'required|current_password',
            'newPassword' => 'required|string|min:6|confirmed',
        ]);


        $curPassword = $request->oldPassword;
        $newPassword = $request->newPassword;

        if (Hash::check($curPassword, $user->password)) {
            $user->fill([
                'password' => Hash::make($newPassword)
            ])->save();

            $request->session()->flash('success', 'Password changed');
            return redirect()->back();

        } else {
            $request->session()->flash('error', 'Password does not match');
            return redirect()->back();
        }
    }

    public function userLog(User $user)
    {
        return view('users.log', compact('user'));
    }
}
