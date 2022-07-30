<?php

namespace App\Http\Livewire\Competences\CompetenceUnits;

use App\Models\Competence;
use App\Models\CompetenceUnit;
use Livewire\Component;

class Index extends Component
{
    public $competence;
    public $competenceUnits;

    public function mount(Competence $competence)
    {
        $this->competence = $competence;
        $this->competenceUnits = $competence->competenceUnits;
    }

    public function render()
    {
        return view('livewire.competences.competence-units.index');
    }
}
