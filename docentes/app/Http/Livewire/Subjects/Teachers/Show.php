<?php

namespace App\Http\Livewire\Subjects\Teachers;

use App\Models\AcademicUnit;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $subject;
    public $authors;
    public $reviewers;
    public $responsible;
    public $teachers;
    public $teachersSelected;
    public $academicUnitSelected;
    public $allAcademicUnits;

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
        $this->responsibles = $subject->responsibles()->get();
        $this->allAcademicUnits = AcademicUnit::get();
        $this->academicUnitSelected = $this->subject->academicUnits()->exists() ? $this->subject->academicUnits()->first() : AcademicUnit::first();
        $this->teachers = Teacher::whereAcademicUnit($this->academicUnitSelected)->orderBy('name')->get();
        $this->reviewers = $subject->reviewers;
        $this->authors = $subject->collaborators;
    }

    public function render()
    {
        return view('livewire.subjects.teachers.show');
    }

    public function teachersWhereAcademicUnit(?string $teacherId , int $academicUnitId)
    {
        return Teacher::search($teacherId)->whereAcademicUnit(AcademicUnit::find($academicUnitId))
            ->get()
            ->toJson();
    }
}
