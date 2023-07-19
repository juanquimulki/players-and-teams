<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Team;

class TeamController extends Controller
{
    public function show(): View
    {
        $players = User::scopeOfPlayers();
        $numOfTeams = (int) (count($players) / 18);

        $teams = [];
        for ($i = 0; $i < $numOfTeams; $i++) {
            $newTeam = new Team();
            $teams[] = $newTeam->jsonSerialize();
        }

        return view('team', [
            'numOfTeams' => $numOfTeams,
            'teams' => $teams,
        ]);
    }
}
