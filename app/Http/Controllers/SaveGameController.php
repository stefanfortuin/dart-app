<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class SaveGameController extends Controller
{
    public function game(Request $request)
	{
		$users_from_request = collect($request->users);

		$game = Game::create([
			'winner_id' => $request->input('winner_id')
		]);

		$game->users()->sync($users_from_request);
	}
}
