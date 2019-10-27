<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaReply extends Model
{
    protected $fillable = [
        'user_id',
        'idea_id',
        'description',
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function idea(){
        return $this->belongsTo('App\Idea');
    }

    public function attaches(){
        return $this->morphMany('App\Photo', 'imageable');
    }
}
