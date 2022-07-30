<?php

namespace App\Http\Livewire\Units;

use App\Models\Unit;
use Livewire\Component;

class Index extends Component
{
    public $units;

    public function mount()
    {
        $this->units = Unit::get();
    }

    public function render()
    {
        return view('livewire.units.index');
    }
}
