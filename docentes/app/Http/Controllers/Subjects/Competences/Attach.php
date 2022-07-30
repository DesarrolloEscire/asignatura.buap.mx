<?php

namespace App\Http\Controllers\Subjects\Competences;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Src\Subjects\Application\AttachCompetences;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Attach extends Controller
{
    public function __invoke(Request $request, Subject $subject)
    {
        (new AttachCompetences)->handle($request, $subject);

        Alert::success('Competencias actualizadas');
        return redirect()->back();
    }
}
