<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{
    public function show(): View
    {
        return view('user', [
            'players' => User::scopeOfPlayers(),
        ]);
    }
}
