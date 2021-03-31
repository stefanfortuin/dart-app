<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class SaveGameController extends Controller
{
	public function game(Request $request)
	{
		$game = collect($request->game);
		$users = collect($request->users);
		$users_only_ids = $users->map(function ($user) {
			return $user->id;
		});

		$game = Game::create($game);
		$game->users()->sync($users_only_ids);

	}
}
