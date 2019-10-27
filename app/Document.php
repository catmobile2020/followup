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

    protected $hidden = [
        'updated_at',
        'status',
        'user_id',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
