<?php

use App\Models\User;
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

Route::get('/', function () {
    return view('app');
});

Route::get('/stats', function () {
	$users = User::all();
    return view('stats', ['users' => $users]);
});

Route::get('/stats/{id}', function (String $id) {
	$user = User::find($id);
	$total_games = $user->games->count();
	$average_per_turn = round($user->turns->average('thrown_score'), 2);
	$won = $user->games->where('winner_id', $id)->count();
	$lost = $total_games - $won;

    return view('stats-user', [
		'user' => $user,
		'total_games' => $total_games,
		'average_per_turn' => $average_per_turn,
		'won' => $won,
		'lost' => $lost,
	]);
});
