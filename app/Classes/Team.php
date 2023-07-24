<?php

namespace App\Classes;
use Faker\Factory as Faker;
use TeamNameGenerator\FakerProvider as FakerTeamNamesProvider;

class Team
{
    public $name;
    public $size;
    public $totalRanking;
    public $players;

    public function __construct()
    {
        // Get a funny team name
        $faker = Faker::create();
        $faker->addProvider(new FakerTeamNamesProvider($faker));

        // Initialize team values
        $this->name = $faker->teamName;
        $this->players = collect([]);
        $this->size = 0;
        $this->totalRanking = 0;
    }

    public function assignPlayer($player) {
        // Assign the player to this team
        $this->players->push($player);
        // Increment team size
        $this->size++;
        // Sum the player ranking to team ranking
        $this->totalRanking += $player->ranking;
    }
}
