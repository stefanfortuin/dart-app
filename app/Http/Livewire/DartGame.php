<?php

namespace App\Http\Livewire;

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

	public function goToNextStep()
	{
		$this->currentStep++;
	}

	public function setStartingUser($user)
	{
		$this->startingUser = $user;
	}

    public function render()
    {
        return view('livewire.dart-game');
    }
}
