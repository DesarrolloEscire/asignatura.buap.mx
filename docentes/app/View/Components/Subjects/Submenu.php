<?php

namespace App\View\Components\Subjects;

use App\Models\Subject;
use Illuminate\View\Component;

class Submenu extends Component
{
    public $subject;
    public $activeSection;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Subject $subject, string $activeSection)
    {
        $this->subject = $subject;
        $this->activeSection = $activeSection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.subjects.submenu');
    }
}
