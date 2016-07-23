<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banned extends Model
{
    protected $fillable = [
        'admin',
        'user_id',
        'ended_at',
    ];

    protected $dates = ['ended_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function adminUser()
    {
        return $this->belongsTo('App\User', 'admin');
    }

    public function isBanned()
    {
        return $this->ended_at > new \DateTime();
    }
}
