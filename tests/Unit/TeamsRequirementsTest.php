<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tournament;

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
        $confidenceParameter = 4;

        $min = $this->teams->min("totalRanking");
        $max = $this->teams->max("totalRanking");

        $this->assertLessThanOrEqual($confidenceParameter,$max - $min);
    }
}
