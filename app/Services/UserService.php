<?php

namespace App\Services;

use App\Contracts\IUserService;
use App\Models\User;

class UserService implements IUserService {

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
