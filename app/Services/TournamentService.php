<?php

namespace App\Services;

use App\Classes\Tournament;
use App\Contracts\ITournamentService;

class TournamentService implements ITournamentService {

    public function generateTeams(object $goalies, object $players): object
    {
        $tournament = new Tournament($goalies, $players);
        return $tournament->generateTeams();
    }
}
