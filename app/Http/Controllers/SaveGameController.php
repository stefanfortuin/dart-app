<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class SaveGameController extends Controller
{
	public function game(Request $request)
	{
		$request_game = $request->game;
		$users = collect($request->users);
		$users_only_ids = $users->map(function ($user) {
			return $user['id'];
		});
		
		try {
			$game = Game::create([
				'winner_id' => $request_game['winner_id']
			]);

			$game->sets = $request_game['sets'];
			$game->save();

			$game->users()->sync($users_only_ids);

			$game->refresh();
		}
		catch(\Exception $e){
			return response()->json(['success' => false, 'message' => 'Kon het spel niet opslaan']);
		}
		
		return response()->json(['success' => true, 'message' => 'Spel opgeslagen!']);
	}
}
