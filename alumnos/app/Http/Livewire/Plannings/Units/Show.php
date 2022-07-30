<?php

namespace App\Http\Livewire\Plannings\Units;

use App\Models\Planning;
use App\Models\Unit;
use App\Models\UnitContent;
use Livewire\Component;

class Show extends Component
{
    public $planning;
    public $strategies;
    public $unit;
    public $unitContent;

    public function mount(Planning $planning, Unit $unit)
    {
        $this->planning = $planning;
        $this->unit = $unit;

        $this->unitContent = UnitContent::firstOrCreate([
            'unit_id' => $unit->id,
            'planning_id' => $planning->id
        ]);

        $this->strategies = $planning
            ->subject
            ->strategies;

        $this->resources = $planning
            ->subject
            ->resources;
    }

    public function render()
    {
        return view('livewire.plannings.units.show');
    }
}
