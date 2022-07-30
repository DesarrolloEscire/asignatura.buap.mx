<?php

namespace App\Src\Subjects\Application;

use App\Models\Subject;
use Illuminate\Http\Request;

class AttachCompetences
{
    public function handle(Request $request, Subject $subject)
    {
        $subject->competences()->sync($request->competence_ids);
    }
}
