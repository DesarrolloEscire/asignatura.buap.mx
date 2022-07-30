<?php

namespace App\Src\Units\Application;

use App\Models\Unit;
use Illuminate\Http\Request;

class UpdateUnit
{
    public function handle(Unit $unit, Request $request)
    {
        $unit->update([
            'name' => $request->unit_name
        ]);
    }
}
