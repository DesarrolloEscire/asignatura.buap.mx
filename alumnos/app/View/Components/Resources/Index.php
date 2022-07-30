<?php

namespace App\View\Components\Resources;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Index extends Component
{
    public $resources;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $resources)
    {
        $this->resources = $resources;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.resources.index');
    }
}
