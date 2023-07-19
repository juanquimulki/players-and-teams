<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;
use App\Models\Team;

class TeamController extends Controller
{
    public function show(): View
    {
        //$allPlayers = User::scopeOfPlayers();
        $allPlayers = User::getAllPlayers();
        $players    = User::getPlayers(false);
        $goalies    = User::getPlayers(true);

        // TODO: check if it's even
        //$numOfTeams = (int) ((count($players) + count($goalies)) / 18);
        $numOfTeams = (int) (count($allPlayers) / 18);

//        foreach ($allPlayers as $player) {
//            echo $player->full_name . " " . $player->ranking . " " . "<br>";
//        }

        $teams = [];
        for ($i = 0; $i < $numOfTeams; $i++) {
            $teams[] = new Team();
        }

        $index = 0;
        $status = "ASC";
        foreach ($allPlayers as $player) {
            $teams[$index]->assignPlayer($player);

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

        for ($i = 0; $i < $numOfTeams; $i++) {
            $teams[$i] = $teams[$i]->jsonSerialize();
        }

        return view('team', [
            'teams' => $teams,
        ]);
    }
}
