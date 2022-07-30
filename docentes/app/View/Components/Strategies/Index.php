<?php

namespace App\View\Components\Strategies;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Index extends Component
{
    public $strategies;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $strategies)
    {
        $this->strategies = $strategies;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.strategies.index');
    }
}
