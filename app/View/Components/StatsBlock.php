<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatsBlock extends Component
{
	public $title;

	public $max;

    public $value;
	
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $max, $value)
    {
        $this->title = $title;
		$this->max = $max;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.stats-block');
    }
}
