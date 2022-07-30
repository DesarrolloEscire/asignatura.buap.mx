<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users;

    public function mount()
    {
        $this->users = $this->getUsers();
    }

    public function render()
    {
        return view('livewire.users.index');
    }

    public function getUsers(){
        $users = User::get();

        foreach($users as $user){
            $user->name = strtoupper($users->name);
        }
        return $users;
    }
}
