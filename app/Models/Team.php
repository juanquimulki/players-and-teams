<?php

namespace App\Models;
use Faker\Factory as Faker;
use TeamNameGenerator\FakerProvider as FakerTeamNamesProvider;

class Team
{
    private $name;
    private $size;
    private $players;

    public function __construct()
    {
        $faker = Faker::create();
        $faker->addProvider(new FakerTeamNamesProvider($faker));

        $this->name = $faker->teamName;
        $this->size = 0;
        $this->players = [];
    }

    public function setPlayers($players) {
        $this->players = $players;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
}
