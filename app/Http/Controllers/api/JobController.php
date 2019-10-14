<?php

namespace App\Http\Controllers\api;

use App\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
   public function  allJobs(){
       $jobs = Job::all();
       return response()->json(['data'=>$jobs, 'state'=>1], 200);
   }
}
