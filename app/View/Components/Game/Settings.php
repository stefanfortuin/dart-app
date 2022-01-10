<?php

namespace App\View\Components\Game;

use Illuminate\View\Component;

class Settings extends Component
{
	public $users;
	public $startingUser;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($users, $startingUser)
    {
        $this->users = $users;
		$this->startingUser = $startingUser;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.game.settings');
    }
}
