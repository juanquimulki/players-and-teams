<?php

namespace Tests\Unit;

use Tests\TestCase;

class PlayersIntegrityTest extends TestCase
{
    protected $userService;
    protected $tournamentService;

    function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make('App\Contracts\IUserService');
        $this->tournamentService = $this->app->make('App\Contracts\ITournamentService');
    }

    public function testGoaliePlayersExist ()
    {
        $goalies = $this->userService->getPlayersByGoalie(true);

		// Check there are players that have can_play_goalie set as 1
		$this->assertGreaterThanOrEqual(1, $goalies->count());
    }
    public function testOneGoaliePlayerPerTeam ()
    {
        $goalies = $this->userService->getPlayersByGoalie(true);
        $players = $this->userService->getPlayersByGoalie(false);

        // Check that there are at least as many players who can play goalie as there are teams
        $teams = $this->tournamentService->generateTeams($goalies, $players);

        $this->assertGreaterThanOrEqual($teams->count(), $goalies->count());
    }
    public function testNumberOfTeamsAndNumberOfPlayersPerTeam ()
    {
        $goalies = $this->userService->getPlayersByGoalie(true);
        $players = $this->userService->getPlayersByGoalie(false);

        $teams = $this->tournamentService->generateTeams($goalies, $players);

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
