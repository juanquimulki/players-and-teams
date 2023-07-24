<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tournament;

class PlayersIntegrityTest extends TestCase
{
    private $goalies;
    private $players;

    function setUp(): void
    {
        parent::setUp();

        $user = new User();
        $this->goalies = $user->getPlayers(true);
        $this->players = $user->getPlayers(false);
    }

    public function testGoaliePlayersExist ()
    {
		// Check there are players that have can_play_goalie set as 1
		$this->assertGreaterThanOrEqual(1, $this->goalies->count());
    }
    public function testOneGoaliePlayerPerTeam ()
    {
        // Check that there are at least as many players who can play goalie as there are teams
        $tournament = new Tournament($this->goalies, $this->players);
        $tournament->generateTeams();
        $teams = $tournament->getTeams();

        $this->assertGreaterThanOrEqual($this->goalies->count(), $teams->count());
    }
    public function testNumberOfTeamsAndNumberOfPlayersPerTeam ()
    {
        $tournament = new Tournament($this->goalies, $this->players);
        $tournament->generateTeams();
        $teams = $tournament->getTeams();

        // Calculate how many teams can be made so that there is an even number of teams
        $this->assertTrue($teams->count() % 2 == 0,"even number of teams");
        // and they each have between 18-22 players.
        $error = false;
        foreach ($teams as $team) {
            if ($team->players->count() < 18 || $team->players->count() > 22) {
                $error = true;
                break;
            }
        }
        $this->assertFalse($error, "each team have between 18-22 players");
    }
}
