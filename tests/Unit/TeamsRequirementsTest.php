<?php

namespace Tests\Unit;

use App\Classes\Tournament;
use Tests\TestCase;

class TeamsRequirementsTest extends TestCase
{
    protected $userService;

    function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make('App\Contracts\IUserService');
    }

    public function testAtLeastOneGoaliePlayerInEachTeam ()
    {
        $goalies = $this->userService->getPlayersByGoalie(true);
        $players = $this->userService->getPlayersByGoalie(false);
        $tournament = new Tournament($goalies, $players);
        $tournament->generateTeams();
        $teams = $tournament->getTeams();

        $error = false;
        foreach ($teams as $team) {
            $thereIsGoalie = $team->players->firstWhere("is_goalie", true);
            if (!$thereIsGoalie) {
                $error = true;
                break;
            }
        }
		$this->assertFalse($error);
    }

    public function testCombinedRankingMatches ()
    {
        $goalies = $this->userService->getPlayersByGoalie(true);
        $players = $this->userService->getPlayersByGoalie(false);
        $tournament = new Tournament($goalies, $players);
        $tournament->generateTeams();
        $teams = $tournament->getTeams();

        $confidenceParameter = 10;

        $min = $teams->min("totalRanking");
        $max = $teams->max("totalRanking");

        $this->assertLessThanOrEqual($confidenceParameter,$max - $min);
    }
}
