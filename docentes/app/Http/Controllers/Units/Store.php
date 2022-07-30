<?php

namespace App\Http\Controllers\Units;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Unit;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Store extends Controller
{
    public function __invoke(Request $request, Subject $subject)
    {
        $unit = Unit::create([
            'name' => $request->unit_name,
        ]);

        $subject->units()->syncWithoutDetaching($unit->id);

        Alert::success('unidad creada');
        return redirect()->route('subjects.contents.show', [$subject]);
    }
}
