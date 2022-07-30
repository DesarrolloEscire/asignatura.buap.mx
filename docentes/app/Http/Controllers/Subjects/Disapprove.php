<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Mail\ModifiableSubjectMail;
use App\Models\Subject;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class Disapprove extends Controller
{
    public function __invoke(Subject $subject)
    {
        $subject->disapprove();

        $recipientMails = $subject
            ->responsibles
            ->pluck('email')
            ->flatten()
            ->toArray();

        Mail::to($recipientMails)->send(new ModifiableSubjectMail($subject));

        Alert::success("La asignatura ha sido modificada");
        return redirect()->back();
    }
}
