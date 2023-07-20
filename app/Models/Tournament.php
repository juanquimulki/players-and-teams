<?php

namespace App\Models;

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
        $totalPlayers = $this->players->count() + $this->goalies->count();
        $numOfTeams = (int) ($totalPlayers / 18);
        $numOfTeams = $numOfTeams % 2 === 0 ? $numOfTeams : $numOfTeams - 1;

        $this->teams = collect([]);
        for ($i = 0; $i < $numOfTeams; $i++) {
            $this->teams->push(new Team());
        }

        try {
            for ($i = 0; $i < $numOfTeams; $i++) {
                $this->teams[$i]->assignPlayer($this->goalies[$i]);
                unset($this->goalies[$i]);
            }
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), "Undefined offset")) {
                throw new \Exception("Not enough goalies");
            }
        }

        $this->players = $this->players->merge($this->goalies);
        $this->players = $this->players->sortByDesc("ranking");

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

//        for ($i = 0; $i < $numOfTeams; $i++) {
//            $this->teams[$i] = $this->teams[$i]->jsonSerialize();
//        }
    }

    public function getTeams() {
        return $this->teams;
    }
}
