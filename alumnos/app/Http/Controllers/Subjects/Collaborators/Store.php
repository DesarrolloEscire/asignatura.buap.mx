<?php

namespace App\Http\Controllers\Subjects\Collaborators;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Src\Shared\Domain\BusinessException;
use App\Src\Subjects\Application\AttachCollaborators;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Store extends Controller
{
    public function __invoke(Subject $subject, Request $request)
    {
        try {
            (new AttachCollaborators)
                ->handle($subject, $request);
        } catch (BusinessException $exception) {
            Alert::error($exception->getMessage());
            return redirect()->back();
        }

        Alert::success('¡Autores actualizados!');
        return redirect()->back();
    }
}
