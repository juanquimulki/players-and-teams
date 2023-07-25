<?php

namespace App\Http\Controllers;

use App\Contracts\ITournamentService;
use App\Contracts\IUserService;
use Illuminate\View\View;

class TournamentController extends Controller
{
    public function __construct(protected IUserService $userService, protected ITournamentService $tournamentService) {
        $this->userService = $userService;
        $this->tournamentService = $this->tournamentService;
    }

    public function show() : View
    {
        return view('team', [
            'teams' => self::generate(),
        ]);
    }

    private function generate() : object
    {
        // Get data from models
        $goalies = $this->userService->getPlayersByGoalie(true);
        $players = $this->userService->getPlayersByGoalie(false);

        // Call the algorithm
        $teams = $this->tournamentService->generateTeams($goalies, $players);

        // Return teams object to view
        return $teams;
    }
}
