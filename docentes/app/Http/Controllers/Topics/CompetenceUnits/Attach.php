<?php

namespace App\Http\Controllers\Topics\CompetenceUnits;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Topic;
use App\Models\TopicContent;
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
    public function __invoke(Planning $planning, Topic $topic, Request $request)
    {
        $contentTopic = TopicContent::firstOrCreate([
            'planning_id' => $planning->id,
            'topic_id' => $topic->id
        ]);

        $command = new UpdateCompetenceUnitsCommand(
            $request->competence_unit_ids ?? [],
            $contentTopic
        );

        transaction($command);

        Alert::success('Unidades de competencia actualizadas.');
        return redirect()->back();
    }
}
