<?php

namespace App\View\Components\Subjects;

use App\Models\Subject;
use Illuminate\View\Component;

class Details extends Component
{
    public $subject;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( Subject $subject )
    {
        $this->subject = $subject;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.subjects.details');
    }
}
