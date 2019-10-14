<?php

namespace App\Http\Controllers\api;

use App\Answer;
use App\Survey;
use App\Traits\ApiResponser;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    use ApiResponser;

    public function getSurveys()
    {
        $allSurveys = Survey::where('type', 0)->where('status', 1)->get();
        foreach ($allSurveys as $survey)
        {
            $survey->total_count = $survey->results()->count();
        }
        return response()->json(['data'=>$allSurveys, 'state'=>1]);
    }

    public function getPolls()
    {
        $allSurveys = Survey::where('type', 1)->where('status', 1)->get();
        foreach ($allSurveys as $survey)
        {
            $survey->total_count = $survey->results()->count();
        }
        return response()->json(['data'=>$allSurveys, 'state'=>1]);
    }

    public function getUOM()
    {
        $allSurveys = Survey::where('type', 2)->where('status', 1)->latest()->first();
        $allSurveys->total_count = $allSurveys->results()->count();
        return response()->json(['data'=>$allSurveys, 'state'=>1]);
    }

    public function surveyInfo(Survey $survey)
    {
        $answers = $survey->answers;
        foreach ($answers as $answer)
        {
            $answer->count = $answer->results()->count();
        }

        $survey->total_count = $survey->results()->count();

        return response()->json(['data'=>$survey, 'state'=>1]);
    }

    public function Vote(Request $request, Survey $survey)
    {
        $this->validate($request, [
            'user_id'=>'required|exists:users,id',
            'answer_id'=>'required|exists:answers,id',
        ]);
            $fAnswer = Answer::find($request->answer_id);
            if($fAnswer->survey_id == $survey->id)
            {
                if($survey->results->where('user_id', $request->user_id)->count()> 0){
                    return response()->json(['data'=>'You have voted before', 'state'=>0]);
                }else{
                    $survey->results()->create([
                        'user_id'=>$request->user_id,
                        'answer_id'=>$request->answer_id
                    ]);
                }
            }else{
                return response()->json(['data'=>'please make sure you follow the right action', 'state'=>0]);
            }
        $answers = $survey->answers;
        foreach ($answers as $answer)
        {
            $answer->count = $answer->results()->count();
        }

        $survey->total_count = $survey->results()->count();

        return response()->json(['data'=>$survey, 'state'=>1]);
    }
}
