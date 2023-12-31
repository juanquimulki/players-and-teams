<?php

namespace Tests\Unit;

use Tests\TestCase;

class TeamsRequirementsTest extends TestCase
{
    protected $userService;
    protected $tournamentService;

    function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make('App\Contracts\IUserService');
        $this->tournamentService = $this->app->make('App\Contracts\ITournamentService');
    }

    public function testAtLeastOneGoaliePlayerInEachTeam ()
    {
        $goalies = $this->userService->getPlayersByGoalie(true);
        $players = $this->userService->getPlayersByGoalie(false);
        $teams = $this->tournamentService->generateTeams($goalies, $players);

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
        $teams = $this->tournamentService->generateTeams($goalies, $players);

        $confidenceParameter = 10;

        $min = $teams->min("totalRanking");
        $max = $teams->max("totalRanking");

        $this->assertLessThanOrEqual($confidenceParameter,$max - $min);
    }
}
