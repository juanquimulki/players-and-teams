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

        $goalies = User::getPlayers(true);
        $players = User::getPlayers(false);
        $tournament = new Tournament($goalies, $players);
        $tournament->generateTeams();
        $this->teams = $tournament->getTeams();
    }

    public function testAtLeastOneGoaliePlayerInEachTeam ()
    {
        $error = false;
        foreach ($this->teams as $team) {
            $thereIsGoalie = false;
            foreach ($team->players as $player) {
                if ($player->is_goalie) {
                    $thereIsGoalie = true;
                    break;
                }
            }
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

        $max = $this->max_attribute_in_array($this->teams, "totalRanking");
        $min = $this->min_attribute_in_array($this->teams, "totalRanking");

        $this->assertLessThanOrEqual($confidenceParameter,$max - $min);
    }

    private function max_attribute_in_array($array, $prop) {
        return max(array_map(function($o) use($prop) {
            return $o->$prop;
        },
        $array));
    }
    private function min_attribute_in_array($array, $prop) {
        return min(array_map(function($o) use($prop) {
            return $o->$prop;
        },
        $array));
    }
}
