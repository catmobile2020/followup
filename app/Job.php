<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name',
        'description',
        'file',
        'deadline',
    ];

    protected $hidden = ['deadline'];



    public function user(){
        return $this->belongsTo('App\User');
    }

    public function skills(){
        return $this->belongsToMany('App\Skill');
    }
}
