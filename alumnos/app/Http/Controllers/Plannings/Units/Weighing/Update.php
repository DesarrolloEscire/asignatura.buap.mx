<?php

namespace App\Http\Controllers\Plannings\Units\Weighing;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Unit;
use App\Models\UnitContent;
use App\Src\Shared\Application\UpdateWeighingCommand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Update extends Controller
{
    public function __invoke(Request $request, Planning $planning, Unit $unit)
    {
        $unitContent = UnitContent::firstOrCreate([
            'planning_id' => $planning->id,
            'unit_id' => $unit->id
        ]);

        $command = new UpdateWeighingCommand(
            $request->unit_weighing,
            $unitContent
        );

        transaction($command);

        Alert::success('Ponderación actualizada');
        return redirect()->back();
    }
}
