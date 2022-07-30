<?php

namespace App\Http\Controllers\Subjects\ProfessionalProfiles;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Src\Subjects\Application\StoreProfessionalProfile;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Store extends Controller
{
    public function __invoke(Subject $subject, Request $request)
    {
        (new StoreProfessionalProfile)->hanlde($subject, $request);

        Alert::success('¡Perfil profesional actualizado!');
        return redirect()->back();
    }
}
