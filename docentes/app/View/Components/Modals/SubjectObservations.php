<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;
use App\Models\Subject;

class SubjectObservations extends Component
{

    public $subject;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Subject $subject)
    {
        //
        $this->subject = $subject;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.subject-observations',[
            'subject'=>$this->subject
        ]);
    }
}
