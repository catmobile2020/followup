<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswers extends Model
{
    protected $table = 'survey_answers';

    protected $fillable = [
        'survey_id',
        'answer_id',
        'user_id',
    ];


}
