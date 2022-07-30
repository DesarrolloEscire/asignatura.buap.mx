<?php

namespace App\Http\Controllers\Subjects\CompetenceUnits;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Attach extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Subject $subject)
    {
        $subject->competenceUnits()->sync($request->competence_unit_ids);

        Alert::success('Unidades de competencia actualizadas');
        return redirect()->back();
    }
}
