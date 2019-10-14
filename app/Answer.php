<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'survey_id',
        'answer',
    ];


    public function results(){
        return $this->hasMany('App\SurveyAnswers');
    }

}
