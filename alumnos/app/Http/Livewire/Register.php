<?php

namespace App\Http\Livewire;

use App\Models\RemoteAcademicUnit;
use App\Models\Student;
use Livewire\Component;

class Register extends Component
{
    public $remoteAcademicUnits;
    public $student;

    public function mount()
    {
        $this->remoteAcademicUnits = RemoteAcademicUnit::get();
    }

    public function render()
    {
        return view('livewire.register', [
            'student' => $this->student
        ])->layout('layouts.auth');
    }

    public function searchStudent(string $identifier)
    {
        $student = Student::where('identifier', $identifier)->first();

        if ($student) {
            $student->email = explode('@',$student->email)[0];
            return $student->toJson();
        }

        return null;
    }
}
