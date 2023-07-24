<?php

namespace App\Http\Controllers;

use App\Classes\Tournament;
use App\Services\UserService;
use Illuminate\View\View;

class TournamentController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function generate() : View
    {
        // Get data from models
        $goalies = $this->userService->getPlayersByGoalie(true);
        $players = $this->userService->getPlayersByGoalie(false);

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
