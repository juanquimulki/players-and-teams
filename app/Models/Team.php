<?php

namespace App\Models;
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
        $faker = Faker::create();
        $faker->addProvider(new FakerTeamNamesProvider($faker));

        $this->name = $faker->teamName;
        $this->players = collect([]);
        $this->size = 0;
        $this->totalRanking = 0;
    }

    public function assignPlayer($player) {
        $this->players->push($player);
        $this->size++;
        $this->totalRanking += $player->ranking;
    }

//    public function jsonSerialize() {
//        return (object) get_object_vars($this);
//    }
}
