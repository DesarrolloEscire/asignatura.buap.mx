<?php

namespace App\Http\Livewire\Subjects\GeneralInformation;

use App\Models\Subject;
use Livewire\Component;

class Show extends Component
{
    public $subject;

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function render()
    {
        return view('livewire.subjects.general-information.show');
    }
}
