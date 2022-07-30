<?php

namespace App\Http\Controllers\Subjects\EducationalPrograms;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Src\EducationalProgram\Application\EducationalProgramPDF;

class PDF extends Controller
{
    public function __invoke(Subject $subject)
    {
        return (new EducationalProgramPDF($subject))
            ->stream();
    }
}
