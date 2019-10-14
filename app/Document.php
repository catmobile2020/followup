<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable =
        [
            'user_id',
            'title',
            'description',
            'category',
            'path',
            'type',
            'status',
        ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
