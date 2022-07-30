<?php

namespace App\Http\Controllers\Competences\CompetenceUnits;

use App\Http\Controllers\Controller;
use App\Models\CompetenceUnit;
use Illuminate\Http\Request;

class Delete extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CompetenceUnit $competenceUnit)
    {
        $competenceUnit->delete();

        return redirect()->back();
    }
}
