<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Turn;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class DartController extends Controller
{
	public function users(Request $request)
	{
		$user_one = User::firstOrCreate([
			'name' => ucfirst($request->input('user_one')),
		]);

		$user_two = User::firstOrCreate([
			'name' => ucfirst($request->input('user_two')),
		]);

		return [
			new UserResource($user_one),
			new UserResource($user_two),
		];
	}

	public function game(Request $request)
	{
		$users_from_request = $request->users;
		$turns_from_request = $request->turns;

		$game = Game::create([
			'winner_id' => $request->input('winner_id')
		]);

		collect($turns_from_request)->each(function ($turn) use ($game) {
			$db_turn = Turn::create($turn);
			$db_turn->game()->associate($game);
			$db_turn->save();
		});

		$game->users()->sync($users_from_request);
	}
}
