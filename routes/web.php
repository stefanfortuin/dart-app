<?php

use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/play', function () {
    return view('app');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/feed', function () {
    return view('feed');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/stats', function () {
	$total_games = Game::count();
    return view('stats', ['total_games' => $total_games]);
});

Route::get('/stats/{id}', function (String $id) {
	$user = User::find($id);
	$total_games = $user->total_games;
	$total_sets = $user->total_sets;

	$total_sets_won = $user->total_sets_won;

	$total_sets_lost = $total_sets - $total_sets_won;

	$average_per_turn = $user->average_per_turn;
	$won = $user->total_games_won;
	$lost = $total_games - $won;

    return view('stats-user', [
		'user' => $user,
		'total_games' => $total_games,
		'total_sets' => $total_sets,
		'total_sets_won' => $total_sets_won,
		'total_sets_lost' => $total_sets_lost,
		'average_per_turn' => $average_per_turn,
		'won' => $won,
		'lost' => $lost,
	]);
});
