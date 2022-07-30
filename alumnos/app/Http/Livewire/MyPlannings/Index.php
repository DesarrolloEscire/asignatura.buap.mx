<?php

namespace App\Http\Livewire\MyPlannings;

use App\Models\Planning;
use Livewire\Component;

class Index extends Component
{
    public $plannings;

    public function mount()
    {
        $this->plannings = Planning::whereUser(auth()->user())->orderBy('created_at','desc')->get();
    }

    public function render()
    {
        return view('livewire.my-plannings.index');
    }
}
