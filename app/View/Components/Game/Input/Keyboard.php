<?php

namespace App\View\Components\Game\Input;

use Illuminate\View\Component;

class Keyboard extends Component
{
	public $score;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($score)
    {
        $this->score = $score;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.game.input.keyboard');
    }
}
