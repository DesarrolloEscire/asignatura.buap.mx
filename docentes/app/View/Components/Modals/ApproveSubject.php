<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;
use App\Models\Subject;

class ApproveSubject extends Component
{
    public $subject;
    public $dynamic;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Subject $subject, $dynamic = null)
    {
        $this->subject = $subject;
        $this->dynamic = $dynamic;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.approve-subject',[
            'subject'=>$this->subject
        ]);
    }
}
