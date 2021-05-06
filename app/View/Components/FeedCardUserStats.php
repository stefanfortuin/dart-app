<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FeedCardUserStats extends Component
{
    public $title;

    public $metric;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $metric)
    {
        $this->title = $title;
        $this->metric = $metric;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.feed-card-user-stats');
    }
}
