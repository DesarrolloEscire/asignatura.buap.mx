<?php

namespace App\Http\Livewire\Plannings;

use App\Models\Planning;
use App\Models\Subject;
use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $planning;
    public $allUsers;
    public $userAuthors;
    public $userCollaborators;

    public function mount(Planning $planning)
    {
        $this->planning = $planning;
        $this->userCollaborators = $planning->users()->get();
        $this->allUsers = User::whereNotIn('id',$this->userCollaborators->pluck('id'))->get();
    }

    public function render()
    {
        return view('livewire.plannings.show');
    }

    public function usersWhereIdentifier(string $term)
    {
        return User::search($term)->get()->toJson();
    }
}
