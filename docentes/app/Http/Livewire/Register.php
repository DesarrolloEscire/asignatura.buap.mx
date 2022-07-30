<?php

namespace App\Http\Livewire;

use App\Models\RemoteAcademicUnit;
use App\Models\Teacher;
use Livewire\Component;

class Register extends Component
{
    public $remoteAcademicUnits;
    public $teacher;

    public function mount()
    {
        $this->remoteAcademicUnits = RemoteAcademicUnit::get();
    }

    public function render()
    {
        return view('livewire.register', [
            'teacher' => $this->teacher
        ])->layout('layouts.auth');
    }

    public function searchTeacher(string $identifier)
    {
        $teacher = Teacher::where('identifier', $identifier)->first();

        if ($teacher) {
            $teacher->email = explode('@',$teacher->email)[0];
            return $teacher->toJson();
        }

        return null;
    }
}
