<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
      'name',
      'email',
      'address',
        'phone',
        'user_id',
      'description',
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }


}
