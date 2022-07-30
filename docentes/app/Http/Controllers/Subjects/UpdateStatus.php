<?php

namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Src\Subjects\Application\UpdateStatus as SubjectUpdateStatus;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UpdateStatus extends Controller
{
    public function __invoke(Subject $subject, Request $request)
    {
        (new SubjectUpdateStatus)->handle($subject, $request);

        Alert::success('Tipo de Programa actualizado!');
        return redirect()->back();
    }
}
