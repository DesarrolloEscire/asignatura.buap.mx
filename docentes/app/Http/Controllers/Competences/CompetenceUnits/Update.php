<?php

namespace App\Http\Controllers\Competences\CompetenceUnits;

use App\Http\Controllers\Controller;
use App\Models\CompetenceUnit;
use Illuminate\Http\Request;

class Update extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, CompetenceUnit $competenceUnit)
    {
        $competenceUnit->update([
            'description' => $request->competence_unit_description
        ]);

        return redirect()->back();
    }
}
