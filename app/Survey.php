<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
      'title',
        'status',
        'user_id',
    ];

    protected $hidden = [
      'type',
      'updated_at',
    ];


    public function answers (){
        return $this->hasMany('App\Answer');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function results(){
        return $this->hasMany('App\SurveyAnswers');
    }

}
