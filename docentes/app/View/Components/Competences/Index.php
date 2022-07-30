<?php

namespace App\View\Components\Competences;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Index extends Component
{
    public $competences;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $competences)
    {
        $this->competences = $competences;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.competences.index');
    }
}
