<?php

namespace App\Http\Controllers\Subtopic\CompetenceUnits;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Subtopic;
use App\Models\SubtopicContent;
use App\Src\Plannings\Topics\Application\UpdateCompetenceUnitsCommand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Attach extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Planning $planning, Subtopic $subtopic, Request $request)
    {
        $subtopicContent = SubtopicContent::firstOrCreate([
            'planning_id' => $planning->id,
            'subtopic_id' => $subtopic->id
        ]);

        $command = new UpdateCompetenceUnitsCommand(
            $request->competence_unit_ids ?? [],
            $subtopicContent
        );

        transaction($command);

        Alert::success('Unidades de competencia actualizadas.');
        return redirect()->back();
    }
}
