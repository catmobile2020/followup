<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::where('type', 0)->get();
        return view('survey.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('survey.create');
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
            'title.required'=>'please enter a question...'
        ]);
        $survey = Survey::create([
            'title' => $request->title,
            'user_id' => Auth::user()->id
        ]);
        return redirect('/admin/survey/'.$survey->id.'/answers/create')->with('status', 'Your Survey has been created .. add answers to survey');
    }


    public function AnswerCreate(Survey $survey)
    {
        return view('survey.answer-create', compact('survey'));
    }

    public function AnswerStore(Request $request){
        $this->validate($request, [
            'answer'=>'required|string',
        ], [
            'answer.required'=>'please enter an answer first...'
        ]);
        $answer= Answer::create($request->all());
        return redirect()->back()->with('status', 'Your answer has been created .. add another one');
;
    }

    public function AnswerDelete(Answer $answer){


        if($answer->results()->count() > 0){
            $answer->results()->delete();
        }
        $answer->delete();

        return redirect()->back()->with('status', 'Your answer has been Deleted With all votes');
        ;
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
        return view('survey.edit', compact('survey'));
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
