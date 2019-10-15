<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $fillable=['date_from','date_to','active'];

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
}
