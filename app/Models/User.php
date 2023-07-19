<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model
{
    public $timestamps = false;
    protected $appends = ['full_name', 'is_goalie'];

    public function getFullNameAttribute() : string
    {
        return Str::title("{$this->first_name} {$this->last_name}");
    }

    public function getIsGoalieAttribute(): bool
    {
        return (bool) $this->can_play_goalie;
    }

    public function scopeOfPlayers() : object
    {
        return User::where('user_type', 'player')->get();
    }

    public function getPlayers(bool $isGoalie) : object
    {
        return User::where('user_type', 'player')
            ->where('can_play_goalie', $isGoalie)
            ->orderByDesc('ranking')
            ->get();
    }
}
