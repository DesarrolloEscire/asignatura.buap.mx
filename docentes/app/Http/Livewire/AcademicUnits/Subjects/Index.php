<?php

namespace App\Http\Livewire\AcademicUnits\Subjects;

use App\Models\AcademicUnit;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    private $subjects;
    public $academicUnit;
    public $searchTerm = "";

    public function mount(AcademicUnit $academicUnit){
        $this->academicUnit = $academicUnit;
        $this->subjects = $academicUnit->subjects;
    }

    public function render()
    {
        $this->onSearchSubject();
        return view('livewire.subjects.index', [
            'subjects' => $this->subjects
        ]);
    }

    private function onSearchSubject()
    {
        $this->subjects = Subject::orderBy('title', 'asc')
            ->whereAcademicUnit($this->academicUnit)
            ->search($this->searchTerm)
            ->paginate(10);

        $this->resetPage();
    }
}
