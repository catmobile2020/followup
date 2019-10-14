<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferPrice extends Model
{
    protected $fillable = [
        'notes',
        'procurement_id',
    ];


    public function procurement(){
        return $this->belongsTo('App\Procurement');
    }

    public function photos(){
        return $this->morphMany('App\Photo', 'imageable');
    }


}
