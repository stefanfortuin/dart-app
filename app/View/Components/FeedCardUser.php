<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FeedCardUser extends Component
{
    public $user;

    public $game;

    public $align;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user, $game, $align = 'left')
    {
        $this->user = $user;
        $this->game = $game;
        $this->align = $align;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.feed-card-user');
    }
}
