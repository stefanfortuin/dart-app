<?php

namespace App\View\Components\Game;

use App\Models\Game;
use Illuminate\View\Component;

class Board extends Component
{
	public Game $game;
	public $users;
	public $score;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Game $game, $users, $score)
    {
        $this->game = $game;
		$this->users = $users;
		$this->score = $score;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.game.board');
    }
}
