<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;
use App\Models\Team;
use App\Models\Tournament;

class TeamController extends Controller
{
    public function show(): View
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
