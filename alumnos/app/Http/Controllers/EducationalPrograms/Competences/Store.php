<?php

namespace App\Http\Controllers\EducationalPrograms\Competences;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use App\Models\EducationalProgram;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Store extends Controller
{
    public function __invoke(Request $request, EducationalProgram $educationalProgram)
    {
        $competence = Competence::firstOrCreate([
            'description' => $request->competence_description,
            'type' => Competence::SPECIFIC_TYPE
        ]);

        $educationalProgram->competences()->syncWithoutDetaching($competence->id);

        Alert::success("competencia creada");
        return redirect()->back();
    }
}
