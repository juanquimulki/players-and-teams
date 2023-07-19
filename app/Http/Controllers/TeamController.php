<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;
use App\Models\Team;

class TeamController extends Controller
{
    public function show(): View
    {
        $goalies    = User::getPlayers(true);
        $players    = User::getPlayers(false);

        $totalPlayers = $players->count() + $goalies->count();
        $numOfTeams = (int) ($totalPlayers / 18);
        $numOfTeams = $numOfTeams % 2 === 0 ? $numOfTeams : $numOfTeams - 1;

        $teams = [];
        for ($i = 0; $i < $numOfTeams; $i++) {
            $teams[] = new Team();
        }

        try {
            for ($i = 0; $i < $numOfTeams; $i++) {
                $teams[$i]->assignPlayer($goalies[$i]);
                unset($goalies[$i]);
            }
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), "Undefined offset")) {
                throw new \Exception("Not enough goalies");
            }
        }

        $players = $players->merge($goalies);
        $players = $players->sortByDesc("ranking");

        $index = $numOfTeams - 1;
        $status = "DESC";
        foreach ($players as $player) {
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

        // TODO: divide generation and viewing
        return view('team', [
            'teams' => $teams,
        ]);
    }
}
