<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Radio extends Component
{
	public $id;
	public $label;
	public $name;
	public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $label, $name, $value)
    {
        $this->id = $id;
		$this->label = $label;
		$this->name = $name;
		$this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input.radio');
    }
}
