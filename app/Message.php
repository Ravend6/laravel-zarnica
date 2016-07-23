<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'receiver_id',
        'is_read',
        'type',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver_id');
    }
}
