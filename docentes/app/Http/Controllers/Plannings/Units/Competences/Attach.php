<?php

namespace App\Http\Controllers\Plannings\Units\Competences;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Unit;
use App\Models\UnitContent;
use App\Src\Shared\Application\AttachCompetences;
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

        (new AttachCompetences)->handle($request, $unitContent);

        Alert::success('Competencias actualizadas');
        return redirect()->back();
    }
}
