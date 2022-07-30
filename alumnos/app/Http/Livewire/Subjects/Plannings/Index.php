<?php

namespace App\Http\Livewire\Subjects\Plannings;

use App\Models\Subject;
use Livewire\Component;

class Index extends Component
{
    public $subject;

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function render()
    {
        return view('livewire.subjects.plannings.index');
    }
}
