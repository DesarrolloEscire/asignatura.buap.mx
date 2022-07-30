<?php

namespace App\Http\Controllers\Plannings\Units\Strategies;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Unit;
use App\Models\UnitContent;
use App\Src\Shared\Application\AttachStrategies;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Attach extends Controller
{
    public function __invoke(Request $request, Planning $planning, Unit $unit)
    {
        $unitContent = UnitContent::firstOrCreate([
            'planning_id' => $planning->id,
            'unit_id' => $unit->id
        ]);

        (new AttachStrategies)->handle(
            $this->removeNullValues($request->strategy_descriptions),
            $unitContent
        );

        Alert::success('¡Estrategias actualizadas!');
        return redirect()->back();
    }

    private function removeNullValues(?array $strategyIds)
    {
        return $strategyIds ? array_filter($strategyIds) : [];
    }
}
