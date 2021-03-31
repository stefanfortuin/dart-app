<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class SaveGameController extends Controller
{
	public function game(Request $request)
	{
		$game = collect($request->game);

		$game = Game::create($game);
		
	}
}
