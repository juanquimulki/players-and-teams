<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\User;
use Illuminate\View\View;

class TournamentController extends Controller
{
    public function generate() : View
    {
        // Get data from models
        $goalies = User::getPlayers(true);
        $players = User::getPlayers(false);

        // Call the algorithm
        $tournament = new Tournament($goalies, $players);
        $tournament->generateTeams();
        $teams = $tournament->getTeams();

        // Return teams object to view
        return view('team', [
            'teams' => $teams,
        ]);
    }
}
