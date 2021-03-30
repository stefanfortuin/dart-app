<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class SaveGameController extends Controller
{
	public function game(Request $request)
	{
		$sets = collect($request->sets);

		$simple_sets = $sets->map(function ($set) {
			return [
				'winner_id' => $set["winner_id"]
			];
		});

		$all_legs = $sets->map(function ($set) {
			return $set["legs"];
		});

		$game = Game::create([
			'winner_id' => $request->input('winner_id')
		]);

		$game->sets()->createMany($simple_sets);

		// $game->users()->sync($users_from_request);
	}
}
