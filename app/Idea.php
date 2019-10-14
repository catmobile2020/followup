<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $fillable = [
        'subject',
        'description',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function attaches(){
        return $this->morphMany('App\Photo', 'imageable');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'idea_receiver');
    }

    public function replies(){
        return $this->hasMany('App\IdeaReply');
    }

}
