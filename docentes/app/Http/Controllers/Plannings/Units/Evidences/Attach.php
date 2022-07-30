<?php

namespace App\Http\Controllers\Plannings\Units\Evidences;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Unit;
use App\Models\UnitContent;
use App\Src\Shared\Application\AttachEvidences;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Attach extends Controller
{
    public function __invoke(Request $request, Planning $planning, Unit $unit)
    {
        $unitContent = UnitContent::firstOrCreate([
            'planning_id' => $planning->id,
            'unit_id' => $unit->id,
        ]);

        (new AttachEvidences)->handle(
            $this->removeNullValues($request->evidence_descriptions),
            $unitContent
        );

        Alert::success('¡Evidencias actualizadas!');
        return redirect()->back();
    }

    private function removeNullValues(?array $evidenceIds)
    {
        return $evidenceIds ? array_filter($evidenceIds) : [];
    }
}
