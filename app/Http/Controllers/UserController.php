<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show(): View
    {
        return view('user', [
            'players' => $this->userService->getAllPlayers(),
        ]);
    }
}
