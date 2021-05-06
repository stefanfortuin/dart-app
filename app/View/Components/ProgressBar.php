<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProgressBar extends Component
{
    public $max;

    public $value;

    public $width;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($max, $value)
    {
        $this->max = $max;
        $this->value = $value;
        $this->width = $this->calculateWidth();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.progress-bar');
    }

    private function calculateWidth(){
        return $this->value / $this->max * 100;
    }
}
