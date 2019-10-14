<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcurementLog extends Model
{
    protected $fillable = [
        'procurement_id',
        'user_id',
        'notes',
        'status',

    ];

    public function procurement(){
        return $this->belongsTo('App\Procurement');
    }

    public function photos(){
        return $this->morphMany('App\Photo', 'imageable');
    }
}
