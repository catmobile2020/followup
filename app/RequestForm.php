<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForm extends Model
{
    protected $fillable=['title'];

    public function team()
    {
     return $this->belongsTo(Team::class);
    }

    public function elements()
    {
        return $this->hasMany(RequestElement::class);
    }
}
