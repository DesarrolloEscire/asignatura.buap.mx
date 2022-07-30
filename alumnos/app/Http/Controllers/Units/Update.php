<?php

namespace App\Http\Controllers\Units;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Src\Units\Application\UpdateUnit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Update extends Controller
{
    public function __invoke(Unit $unit, Request $request)
    {
        (new UpdateUnit)->handle($unit, $request);

        Alert::success('¡Unidad actualizada!');
        return redirect()->back();
    }
}
