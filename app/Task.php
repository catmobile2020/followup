<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=['po','active','values','request_form_id','user_id'];
    protected $appends=['values_array'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function form()
    {
        return $this->belongsTo(RequestForm::class,'request_form_id')->withDefault();
    }

    public function getValuesArrayAttribute()
    {
        return unserialize($this->values);
    }

    public function getActiveNameAttribute()
    {
        switch ($this->active)
        {
            case 0:
                return 'Pending';
                break;
            case 1:
                return 'Agree';
                break;
            case -1:
                return 'DisAgree';
                break;
            default:
                return '';
        }
    }
}
