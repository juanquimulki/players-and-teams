<?php

namespace App\Contracts;

interface IUserService {
    public function getAllPlayers() : object;
    public function getPlayersByGoalie(bool $isGoalie) : object;
}

?>
