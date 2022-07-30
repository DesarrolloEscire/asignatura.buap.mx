<?php

namespace App\Http\Controllers\Plannings;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Src\Plannings\Infraestructure\PlanningPDF;

class PDF extends Controller
{
    public function __invoke(Planning $planning)
    {
        return (new PlanningPDF($planning))->stream();
    }
}
