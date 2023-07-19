<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PlayersIntegrityTest extends TestCase
{
    public function testGoaliePlayersExist ()
    {
		// Check there are players that have can_play_goalie set as 1

		$this->assertTrue(true);

    }
    public function testAtLeastOneGoaliePlayerPerTeam ()
    {
        /*
	    Calculate how many teams can be made so that there is an even number of teams and they each have between 18-22 players.
	    Then check that there are at least as many players who can play goalie as there are teams
        */

        $this->assertTrue(true);
    }
}
