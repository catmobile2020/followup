<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'description',
        'active',
        'created_by'
    ];

    public function users(){
        return $this->belongsToMany('App\User', 'user_skill');
    }

    public function teams(){
        return $this->belongsToMany('App\Team');
    }
}
