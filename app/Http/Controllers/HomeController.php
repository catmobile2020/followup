<?php

namespace App\Http\Controllers;

use App\Group;
use App\Material;
use App\Role;
use App\Skill;
use App\Team;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $roles = Role::all()->count();
        $skills = Skill::all()->count();
        $teams = Team::all()->count();
        $deact_users = User::where('active',0)->count();
        $all_users = User::all()->count();

        return view('home', compact( 'deact_users', 'all_users', 'all_grp', 'skills', 'teams', 'roles'));
    }
}
