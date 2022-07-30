<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

use App\Models\Subject;

class ApprovedSubjects extends Component
{
    public $subjects = [];

    public function mount(){
        $this->subjects = $this->getApprovedSubjectList();
    }    
    
    public function render()
    {
        return view('livewire.reports.approved-subjects');
    }

    public function getApprovedSubjectList(){
        return Subject::With([
            'educationalPrograms',
            'academicUnits',
            'areas',
            'responsibles',
            'collaborators',
            'synopsis'
        ])->Where('is_approved',true)->get();
    }
}
