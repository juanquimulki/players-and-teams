<?php

namespace App\Services;

use App\Models\User;

class UserService {

    public function getAllPlayers() : object
    {
        return User::players()->get();
    }

    public function getPlayersByGoalie(bool $isGoalie) : object
    {
        $user = new User();
        return $user->getPlayers($isGoalie);
    }
}
