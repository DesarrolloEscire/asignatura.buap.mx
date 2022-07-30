<?php

namespace App\View\Components\Instruments;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Index extends Component
{
    public $instruments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $instruments)
    {
        $this->instruments = $instruments;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.instruments.index');
    }
}
