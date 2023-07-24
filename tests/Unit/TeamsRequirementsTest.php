<?php

namespace Tests\Unit;

use App\Classes\Tournament;
use App\Models\User;
use Tests\TestCase;

class TeamsRequirementsTest extends TestCase
{
    private $teams;

    function setUp(): void
    {
        parent::setUp();

        $user = new User();
        $goalies = $user->getPlayers(true);
        $players = $user->getPlayers(false);
        $tournament = new Tournament($goalies, $players);
        $tournament->generateTeams();
        $this->teams = $tournament->getTeams();
    }

    public function testAtLeastOneGoaliePlayerInEachTeam ()
    {
        $error = false;
        foreach ($this->teams as $team) {
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
        $confidenceParameter = 10;

        $min = $this->teams->min("totalRanking");
        $max = $this->teams->max("totalRanking");

        $this->assertLessThanOrEqual($confidenceParameter,$max - $min);
    }
}
