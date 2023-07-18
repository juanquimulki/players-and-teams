<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeOfPlayers()
    {
        return User::where('user_type', 'player')->get();
    }

    public function getPlayers()
    {
        return User::where('id', '>=', 77)->get();
    }
}
