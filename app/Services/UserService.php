<?php

namespace App\Services;

use App\Models\User;

class UserService {

    public function getAllPlayers() : object
    {
        return User::scopeOfPlayers();
    }

    public function getPlayersByGoalie(bool $isGoalie) : object
    {
        return User::getPlayers($isGoalie);
    }
}
