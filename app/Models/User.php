<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    public function scopeOfPlayers()
    {
        return User::where('user_type', 'player')->get();
    }

    public function getValue(): int
    {
        return 12;
    }
}
