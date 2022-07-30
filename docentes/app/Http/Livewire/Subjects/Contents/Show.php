<?php

namespace App\Http\Livewire\Subjects\Contents;

use App\Models\Competence;
use App\Models\Subject;
use Livewire\Component;

class Show extends Component
{
    public $subject;
    public $specificCompetences;
    public $genericCompetences;

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
        $this->genericCompetences = $this->_genericCompetence();
        $this->specificCompetences = $this->_specificCompetences();

        $this->competenceUnits = $this
            ->subject
            ->competences
            ->pluck('competenceUnits')
            ->flatten();
    }

    public function render()
    {
        return view('livewire.subjects.contents.show');
    }

    private function _genericCompetence()
    {
        return $this
            ->subject
            ->possibleCompetences()
            ->generic()
            ->get();
    }

    private function _specificCompetences()
    {
        if (!$this->subject->educationalPrograms) {
            return collect([]);
        }

        return Competence::specific()
            ->whereEducationalProgramIn($this->subject->educationalPrograms)
            ->get();
    }
}
