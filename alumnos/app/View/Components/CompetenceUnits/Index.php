<?php

namespace App\View\Components\CompetenceUnits;

use FontLib\TrueType\Collection;
use Illuminate\View\Component;

class Index extends Component
{
    public $competenceUnits;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( Collection $competenceUnits )
    {
        $this->competenceUnits = $competenceUnits;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.competence-units.index');
    }
}
