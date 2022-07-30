<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Mail\RequestPublicationMail;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class RequestPublication extends Controller
{
    public function __invoke(Subject $subject)
    {
        if (!$subject->areAllModulesCompleted()) {
            Alert::error('Falta información por completar para solicitar la revisión');
            return redirect()->back();
        }

        Mail::to(User::administrators()->pluck('email')->toArray())
            ->send(new RequestPublicationMail($subject));

        Alert::success('¡Tu solicitud ha sido enviada!');
        return redirect()->back();
    }
}
