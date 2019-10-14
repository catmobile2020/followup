<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable =[
        'name',
        'active',
        'created_by',
    ];

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function materials(){
        return $this->belongsToMany('App\Material');
    }
}
