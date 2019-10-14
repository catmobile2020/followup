<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    //
    protected $fillable = ['type'];
    public function notifiable(){
        return $this->morphTo();
    }
}
