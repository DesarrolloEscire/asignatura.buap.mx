<?php

namespace App\Http\Livewire\SubjectPrograms;

use App\Models\EducationalProgram;
use Livewire\Component;

class Show extends Component
{
    public $educationalProgram;

    public function mount(EducationalProgram $educationalProgram)
    {
        $this->educationalProgram = $educationalProgram;
    }

    public function render()
    {
        return view('livewire.subject-programs.show');
    }
}
