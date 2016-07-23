<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    // public function forums()
    // {
    //     return $this->belongsToMany('App\Forum');
    // }
    //
    // public function categories()
    // {
    //     return $this->belongsToMany('App\Category');
    // }
}
