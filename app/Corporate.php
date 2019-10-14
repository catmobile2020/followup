<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    protected $fillable = [
        'about',
        'mission',
        'vision',
    ];
}
