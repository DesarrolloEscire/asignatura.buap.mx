<?php

namespace App\Http\Livewire\Units;

use App\Models\Subject;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $subject;

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function render()
    {
        return view('livewire.units.create');
    }

    public function searchUsers(string $searchTerm)
    {
        return User::search($searchTerm)->get()->toJson();
    }
}
