<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=['values','request_form_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function form()
    {
        return $this->belongsTo(RequestForm::class,'request_form_id');
    }

    public function getValuesArrayAttribute()
    {
        return unserialize($this->values);
    }
}
