<?php

namespace App\Classes;

class Tournament
{
    private $goalies;
    private $players;
    private $teams;

    public function __construct($goalies, $players)
    {
        $this->goalies = $goalies;
        $this->players = $players;
    }

    public function generateTeams()
    {
        $numOfTeams = $this->getNumberOfTeams();
        $this->createTeamsCollection($numOfTeams);

        try {
            $this->assignGoaliesToTeams();
        } catch (\Exception $e) {
            // If this throws an "Undefined offset error", it means there aren't enough goalies
            if (str_contains($e->getMessage(), "Undefined offset")) {
                throw new \Exception("Not enough goalies");
            }
        }

        // Merge players with remaining goalies
        $this->players = $this->players->merge($this->goalies);
        // Sort them again by ranking
        $this->players = $this->players->sortByDesc("ranking");

        // Assign players from the sorted collection
        $this->assignPlayersToTeams();

    }

    private function getNumberOfTeams() : int
    {
        // Get number of players
        $totalPlayers = $this->players->count() + $this->goalies->count();
        // Determine number of teams
        $numOfTeams = (int) ($totalPlayers / 18);
        // Check it's an even number and return
        return $numOfTeams % 2 === 0 ? $numOfTeams : $numOfTeams - 1;
    }


    private function createTeamsCollection(int $numOfTeams)
    {
        // Create a collection of new teams
        $this->teams = collect([]);
        for ($i = 0; $i < $numOfTeams; $i++) {
            $this->teams->push(new Team());
        }
    }

    private function assignGoaliesToTeams()
    {
        $numOfTeams = $this->teams->count();

        // First assign one goalie to each team
        for ($i = 0; $i < $numOfTeams; $i++) {
            $this->teams[$i]->assignPlayer($this->goalies[$i]);
            // Remove the assigned goalie
            unset($this->goalies[$i]);
        }
    }

    private function assignPlayersToTeams() {
        $numOfTeams = $this->teams->count();
        $index = $numOfTeams - 1;
        $status = "DESC";
        foreach ($this->players as $player) {
            $this->teams[$index]->assignPlayer($player);

            if ($status == "ASC") {
                $index++;
                if ($index == $numOfTeams) {
                    $index--;
                    $status = "DESC";
                }
            } elseif ($status == "DESC") {
                $index--;
                if ($index == -1) {
                    $index = 0;
                    $status = "ASC";
                }
            }
        }
    }

    public function getTeams() {
        return $this->teams;
    }
}
