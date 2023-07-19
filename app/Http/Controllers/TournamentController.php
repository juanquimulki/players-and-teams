<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\User;
use Illuminate\View\View;

class TournamentController extends Controller
{
    public function generate() : View
    {
        $goalies = User::getPlayers(true);
        $players = User::getPlayers(false);

        $tournament = new Tournament($goalies, $players);
        $tournament->generateTeams();
        $teams = $tournament->getTeams();

        return view('team', [
            'teams' => $teams,
        ]);
    }
}
