<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    protected $fillable = [
        'company_name',
        'po_number',
        'supplier_id',
        'user_id',
        'items',
        'details',
        'status',
        'deadline',
        'place',
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }


    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }

    public function offers(){
        return $this->hasMany('App\OfferPrice');
    }

    public function logs(){
        return $this->hasMany('App\ProcurementLog');
    }
}
