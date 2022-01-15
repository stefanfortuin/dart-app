<?php

namespace App\Http\Livewire;

use App\Models\Game;
use Livewire\Component;

class DartGame extends Component
{
	public $users = [];
	public $sets = [];
	
	public $totalSets = 1;
	public $totalLegs = 1;
	public $currentStep = 0;
	public $currentLeg = null;
	public $currentSet= null;
	public $startScore = 501;

	public $startingUser;
	public $currentUser;

	public $score;

	public Game $game;

	public function mount()
	{
		$this->game = new Game;
	}

	public function startGame()
	{
		$this->currentStep++;
	}

	public function setStartingUser($user)
	{
		$this->startingUser = $user;
	}

	public function addNumberToScore($number)
	{
		$this->score .= $number;
	}

	public function clearScore()
	{
		$this->score = '';
	}

	public function makeTurn()
	{

	}

    public function render()
    {
        return view('livewire.dart-game');
    }
}
