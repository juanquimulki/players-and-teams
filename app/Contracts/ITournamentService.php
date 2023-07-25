<?php

namespace App\Contracts;

interface ITournamentService {
    public function generateTeams(object $goalies, object $players) : object;
}
