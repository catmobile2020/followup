<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable=['reason','date_from','date_to','type','active','hr_active','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getActiveNameAttribute($key)
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

    public function getHrActiveNameAttribute($key)
    {
        switch ($this->hr_active)
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
