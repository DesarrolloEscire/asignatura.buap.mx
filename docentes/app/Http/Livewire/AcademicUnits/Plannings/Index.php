<?php

namespace App\Http\Livewire\AcademicUnits\Plannings;

use App\Models\AcademicUnit;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = "";
    private $_subjects;

    public $academicUnit;

    public function mount(AcademicUnit $academicUnit)
    {
        $this->academicUnit = $academicUnit;
    }

    public function render()
    {
        $this->onSearchSubject();
        return view('livewire.plannings.index', [
            'subjects' => $this->_subjects
        ]);
    }

    public function onSearchSubject()
    {
        if (!$this->searchTerm) {
            $this->_subjects = Subject::paginate(0)->empty();
            return;
        }

        $this->_subjects = Subject::search($this->searchTerm)
            ->whereAcademicUnit($this->academicUnit)
            ->approved()
            ->paginate(10);

        $this->resetPage();
    }
}
