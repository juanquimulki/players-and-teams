<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class TeamController extends Controller
{
    public function show(): View
    {
        return view('team', [
            'players' => User::getPlayers(),
        ]);
    }
}
