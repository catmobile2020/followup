<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable =
        [
        'name',
        'description',
        'created_by',
        'active',
        ];


    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function skills(){
        return $this->belongsToMany('App\Skill', 'team_skill');
    }


    public function requestsForm()
    {
        return $this->hasMany(RequestForm::class);
    }
}
