<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'status',
        'user_status',
        'caption',
        'karma',
        'ip',
        'steam',
        'sex',
        'birthday',
        'skype',
        'icq',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function friends()
    {
        return $this->hasMany('App\Friend');
    }

    public function messages()
    {
        return $this->hasMany('App\Message', 'receiver_id');
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getRoleListAttribute()
    {
        return $this->roles->lists('id')->toArray();
    }

    public function banneds()
    {
        return $this->hasMany('App\Banned', 'user_id');
    }

    public function owns($related)
    {
        return $this->id == $related->user_id;
    }
}
