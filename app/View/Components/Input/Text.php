<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Text extends Component
{
    public $label;
	public $value;
	public $readonly;
	public $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $readonly = false, $value = '', $label)
    {
        $this->label = $label;
		$this->value = $value;
		$this->readonly = $readonly;
		$this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.input.text');
    }
}
