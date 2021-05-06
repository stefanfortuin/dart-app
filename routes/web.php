<?php

use App\Models\Game;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaveGameController;

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
	$logged_in_user = new UserResource(Auth::user());
    return view('app', ['logged_in_user' => $logged_in_user]);
});

Route::post('/play/upload-game', [SaveGameController::class, 'game'])->middleware('auth');

Route::get('/', function () {
    return view('home');
});

Route::get('/me', function () {
	$user = Auth::user();
    return new UserResource($user);
})->middleware('auth');

Route::get('/feed', function () {
	$user = User::with('games')->find(Auth::id());
	$games = $user->games;

    return view('feed', ['games' => $games]);
})->middleware('auth');

Route::get('/profile', function () {
	$user = User::with('games')->find(Auth::id());

    return view('profile', ['user' => $user]);

})->middleware('auth');

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
