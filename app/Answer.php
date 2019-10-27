<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'survey_id',
        'answer',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function results(){
        return $this->hasMany('App\SurveyAnswers');
    }

    public function suvery()
    {
        return $this->belongsTo('App\Survey');
    }

}
