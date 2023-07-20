<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tournament;

class PlayersIntegrityTest extends TestCase
{
    private $goalies;
    private $teams;

    function setUp(): void
    {
        parent::setUp();

        $this->goalies = User::getPlayers(true);
        $players = User::getPlayers(false);
        $tournament = new Tournament($this->goalies, $players);
        $tournament->generateTeams();
        $this->teams = $tournament->getTeams();
    }

    public function testGoaliePlayersExist ()
    {
		// Check there are players that have can_play_goalie set as 1
		$this->assertGreaterThanOrEqual(1, $this->goalies->count());

    }
    public function testAtLeastOneGoaliePlayerPerTeam ()
    {
        // Check that there are at least as many players who can play goalie as there are teams
        $this->assertGreaterThanOrEqual($this->goalies->count(), count($this->teams));
    }
    public function testNumberOfTeamsAndNumberOfPlayersPerTeam ()
    {
        // Calculate how many teams can be made so that there is an even number of teams
        $this->assertTrue(count($this->teams) % 2 == 0,"even number of teams");
        // and they each have between 18-22 players.
        $error = false;
        foreach ($this->teams as $team) {
            if (count($team->players) < 18 || count($team->players) > 22) {
                $error = true;
            }
        }
        $this->assertFalse($error, "each team have between 18-22 players");
    }
}
