<?php

namespace App\Http\Controllers\Plannings\Units\Resources;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Unit;
use App\Models\UnitContent;
use App\Src\Shared\Application\StoreResources;
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

        (new StoreResources)->handle(
            $this->removeNullValues($request->resource_descriptions),
            $unitContent
        );

        Alert::success('¡recursos actualizados!');
        return redirect()->back();
    }

    private function removeNullValues(?array $resourceIds)
    {
        return $resourceIds ? array_filter($resourceIds) : [];
    }
}
