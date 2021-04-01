<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatsBar extends Component
{
	public $total;

	public $won;

	public $lost;

	public $wonWidth;

	public $lostWidth;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($total, $won, $lost)
    {
        $this->total = $total;
		$this->won = $won;
		$this->lost = $lost;

		$this->calculateWidths();
    }

	private function calculateWidths(){
		$this->wonWidth = round($this->won / $this->total * 100, 0);
		$this->lostWidth = round($this->lost / $this->total * 100, 0);
	}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.stats-bar');
    }
}
