<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subject;

class ApprovedSubjects extends Controller
{
    public function __invoke(){
        $subjects = Subject::With([
            'educationalPrograms',
            'academicUnits',
            'areas',
            'responsibles',
            'collaborators',
            'synopsis'
        ])->Where('is_approved',true)->get();
        return response()->json($subjects);
    }
}
