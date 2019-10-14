<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Survey;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeOfTheMonthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::where('type', 2)->get();
        return view('employee.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
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
            'title'=>'required|string',
        ], [
            'title.required'=>'please enter poll question...'
        ]);
        $survey = Survey::create([
            'title' => $request->title,
            'user_id' => Auth::user()->id
        ]);

        $survey->type = 2;
        $survey->save();
        return redirect('/admin/employee-of-the-month/'.$survey->id.'/users/add')->with('status', 'Your Employee Voting has been created .. assign users !');
    }


    public function AnswerCreate(Survey $survey)
    {
        $users = User::where('active', 1)->get();
        return view('employee.answer-create', compact('survey', 'users'));
    }

    public function AnswerStore(Request $request){
        $this->validate($request, [
            'users'=>'required|array',
        ], [
            'users.required'=>'please Choose an Employee first...'
        ]);
        if(!empty($request->users))
        {
            foreach ($request->users as $user)
            {
                $answer= Answer::create(['survey_id'=> $request->survey_id, 'answer'=> $user]);
            }
        }

        return redirect()->back()->with('status', 'Employee has been added for voting .. assign another one');

    }

    public function AnswerDelete(Answer $answer){


        if($answer->results()->count() > 0){
            $answer->results()->delete();
        }
        $answer->delete();

        return redirect()->back()->with('status', 'Employee has been Deleted With all votes');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        return view('employee.edit', compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        $this->validate($request, [
            'title'=>'required|string',
        ], [
            'title.required'=>'please enter a question...'
        ]);

        $survey->title = $request->title;
        if ($request->status == 'on'){
            $status = 1;
        }
        else{
            $status = 0;
        }
        $survey->status = $status;

        $survey->save();

        return redirect()->back()->with('status', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
