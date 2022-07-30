<?php

namespace App\Http\Controllers\Subjects\SubjectPrograms;

use App\Http\Controllers\Controller;
use App\Models\SubjectProgram;
use Illuminate\Http\Request;

class PDF extends Controller
{
    public function __invoke(SubjectProgram $subjectProgram)
    {
        return response()->file(storage_path("app/" . $subjectProgram->path, "programa-asignatura.pdf"));
    }
}
