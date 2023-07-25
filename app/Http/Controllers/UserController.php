<?php

namespace App\Http\Controllers;

use App\Contracts\IUserService;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(protected IUserService $userService)
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
