<?php

namespace App\Http\Controllers\Units;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Src\Units\Application\DeleteUnit;
use RealRashid\SweetAlert\Facades\Alert;

class Delete extends Controller
{
    public function __invoke(Unit $unit)
    {
        (new DeleteUnit)->handle($unit);

        Alert::success('Unidad eliminada');
        return redirect()->back();
    }
}
