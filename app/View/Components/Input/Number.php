<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Number extends Component
{
    public $label;
	public $id;
	public $max;
	public $min;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $label, $max = null, $min)
    {
        $this->label = $label;
		$this->max = $max;
		$this->min = $min;
		$this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input.number');
    }
}
