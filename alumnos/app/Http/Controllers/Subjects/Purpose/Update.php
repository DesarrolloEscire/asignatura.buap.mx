<?php

namespace App\Http\Controllers\Subjects\Purpose;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\Purpose\UpdatePurposeRequest;
use App\Models\Subject;
use App\Src\Subjects\Application\UpdatePurpose;
use RealRashid\SweetAlert\Facades\Alert;

class Update extends Controller
{
    public function __invoke(UpdatePurposeRequest $request, Subject $subject)
    {
        (new UpdatePurpose)->handle($request, $subject);

        Alert::success('El propósito de la asignatura fue actualizado');
        return redirect()->back();
    }
}
