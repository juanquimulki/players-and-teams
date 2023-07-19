<?php

namespace App\Models;
use Faker\Factory as Faker;
use TeamNameGenerator\FakerProvider as FakerTeamNamesProvider;

class Team
{
    private $name;
    private $size;
    private $totalRanking;
    private $players;

    public function __construct()
    {
        $faker = Faker::create();
        $faker->addProvider(new FakerTeamNamesProvider($faker));

        $this->name = $faker->teamName;
        $this->players = [];
        $this->size = 0;
        $this->totalRanking = 0;
    }

    public function assignPlayer($player) {
        $this->players[] = $player;
        $this->size++;
        $this->totalRanking += $player->ranking;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
}
