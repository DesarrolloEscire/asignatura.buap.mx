<?php

namespace App\View\Components\Evidences;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Index extends Component
{
    public $evidences;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $evidences)
    {
        $this->evidences = $evidences;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.evidences.index');
    }
}
