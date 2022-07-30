<?php

namespace App\Http\Controllers\Subjects\Certificates;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Src\Subjects\Application\StoreCertificate;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Store extends Controller
{
    public function __invoke(Request $request, Subject $subject)
    {

        try {
            (new StoreCertificate)->handle(
                $request->file('certificate_file'),
                $request->approved_at,
                $request->designed_at,
                $request->last_update_at,
                $subject
            );
        } catch (FileNotFoundException $th) {
            Alert::error("No se cargó ningún acta de validación");
            return redirect()->back();
        }

        Alert::success('¡Acta actualizadada!');
        return redirect()->back();
    }
}
