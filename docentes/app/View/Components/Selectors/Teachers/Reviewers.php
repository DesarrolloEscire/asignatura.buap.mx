<?php

namespace App\View\Components\Selectors\Teachers;

use Illuminate\View\Component;

class Reviewers extends Component
{
    public $reviewers;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($reviewers)
    {
        $this->reviewers = $reviewers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.selectors.teachers.reviewers');
    }
}
