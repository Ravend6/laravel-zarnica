<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'user_id',
        'friend_id',
        'is_confirm',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function userFriend()
    {
        return $this->belongsTo('App\User', 'friend_id');
    }

    public function scopeNotconfirm($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->where('is_confirm', false);
    }

    public function scopeConfirm($query, $userId)
    {
        return $query->where('friend_id', $userId)
            ->where('is_confirm', true)
            ->where('type', true)
            ->get();
    }
}
