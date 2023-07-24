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
            if (str_contains($e->getMessage(), "Undefined array")) {
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
            $this->teams->push(new Team($i));
        }
    }

    private function assignGoaliesToTeams()
    {
        $numOfTeams   = $this->teams->count();
        $numOfGoalies = $this->goalies->count();
        $this->goalies = $this->goalies->shuffle();

        // First assign one goalie to each team
        for ($i = 0; $i < $numOfTeams; $i++) {
            $index = rand(0, $numOfGoalies - $i - 1);

            $this->teams[$i]->assignPlayer($this->goalies[$index]);
            // Remove the assigned goalie and reindex
            unset($this->goalies[$index]);
            $this->goalies = $this->goalies->values();
        }
    }

    private function assignPlayersToTeams() {
        $numOfTeams = $this->teams->count();
        $this->players = $this->players->shuffle();

        foreach ($this->players as $player) {
            $maxRanking = $this->teams->max("totalRanking");
            $teamSelected = $this->teams->where("totalRanking", $maxRanking)->first();
            $id = $teamSelected->id;

            do {
                $index = rand(0, $numOfTeams - 1);
            } while ($index == $id || $this->teams[$index]->size >= 22);

            $this->teams[$index]->assignPlayer($player);
        }
    }

    public function getTeams() {
        return $this->teams;
    }
}
