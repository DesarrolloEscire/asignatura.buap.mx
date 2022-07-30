<?php

namespace App\View\Components\Selectors\Teachers;

use Illuminate\View\Component;

class Authors extends Component
{
    public $teachersSelected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($teachersSelected)
    {
        $this->teachersSelected = $teachersSelected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.selectors.teachers.authors');
    }
}
