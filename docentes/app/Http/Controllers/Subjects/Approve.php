<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\SubjectObservation;
use RealRashid\SweetAlert\Facades\Alert;

class Approve extends Controller
{
    public function __invoke(Subject $subject, Request $request)
    {
        if ($request->descripton) {
            $subjectObservation = new SubjectObservation();
            $subjectObservation->is_approved = false;
            $subjectObservation->description = $request->description;
            $subject->subjectObservations()->save($subjectObservation);
        }

        if ($request->is_approved == "false") {
            $subject->disapprove();
            Alert::success('La materia ' . $subject->key . ' ha sido evaluada con estatus No aprobada.');
            return redirect()->back();
        }

        if (!$subject->certificates()->exists()) {
            Alert::error('No se puede validar una materia sin acta de validación.');
            return redirect()->back();
        }

        $subject->approve();
        Alert::success('La materia ' . $subject->key . ' ha sido aprobada.');

        return redirect()->back();
    }
}
