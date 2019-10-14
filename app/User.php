<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    Const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'role_id',
        'team_id',
        'country_id',
        'phone',
        'address',
        'bio',
        'password',
        'verified',
        'verification_token',
        'admin',
        'image_profile',
        'player_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token',
        'admin',
        'updated_at',
        'verified',
        'active',
    ];

    public function isVerified()
    {
        $this->verified == User::VERIFIED_USER;
    }

    public function isAdmin()
    {
        $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }


    public function photos(){
        return $this->morphMany('App\Photo', 'imageable');
    }




    public function skills(){
        return $this->belongsToMany('App\Skill', 'user_skill');
    }

    public function team(){
        return $this->belongsTo('App\Team');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }


    public function procurements(){
        return $this->hasMany('App\Procurement');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function ideas(){
        return $this->hasMany('App\Idea');
    }

    public function ideass(){
        return $this->belongsToMany('App\Idea', 'idea_receiver');
    }

    public function country(){
        return $this->belongsTo('App\Country');
    }
}
