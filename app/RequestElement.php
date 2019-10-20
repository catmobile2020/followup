<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestElement extends Model
{
    protected $fillable=['title','type','value','validation','placeholder','request_form_id'];

    public function form()
    {
        return $this->belongsTo(RequestForm::class);
    }
}
