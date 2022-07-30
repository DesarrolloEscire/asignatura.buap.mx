<?php

namespace App\Src\Units\Application;

use App\Models\Unit;

class DeleteUnit
{

    public function handle(Unit $unit)
    {
        $unit->delete();
    }
}
