<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;

// Route::get('/', function () {
//     return view('main');
// });
Route::redirect('/', '/players');
Route::get('/players', [UserController::class, 'show']);
Route::get('/teams',   [TeamController::class, 'show']);
