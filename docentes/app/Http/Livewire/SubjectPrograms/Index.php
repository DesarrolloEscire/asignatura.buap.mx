<?php

namespace App\Http\Livewire\SubjectPrograms;

use App\Models\EducationalProgram;
use Livewire\Component;

class Index extends Component
{
    public $educationalPrograms;

    public function mount()
    {
        $this->educationalPrograms = EducationalProgram::get();
    }

    public function render()
    {
        return view('livewire.subject-programs.index');
    }
}
