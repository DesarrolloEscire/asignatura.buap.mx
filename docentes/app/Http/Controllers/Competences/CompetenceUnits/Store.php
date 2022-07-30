<?php

namespace App\Http\Controllers\Competences\CompetenceUnits;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use App\Models\EducationalProgram;
use Illuminate\Http\Request;

class Store extends Controller
{
    public function __invoke(Competence $competence, Request $request)
    {
        $competence->competenceUnits()->create([
            'description' => $request->competence_unit_description
        ]);

        return redirect()->back();
    }
}
