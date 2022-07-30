<?php

namespace App\Http\Controllers\Plannings\Subtopics\Hours;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\SubtopicContent;
use App\Models\Subtopic;
use App\Src\Subtopics\Application\UpdateHoursCommand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Update extends Controller
{
    public function __invoke(Request $request, Planning $planning, Subtopic $subtopic)
    {
        $subtopicContent = SubtopicContent::firstOrCreate([
            'planning_id' => $planning->id,
            'subtopic_id' => $subtopic->id,
        ]);

        $command = new UpdateHoursCommand(
            $request->subtopic_theoretical_hours,
            $request->subtopic_practical_hours,
            $request->subtopic_independent_hours,
            $request->subtopic_tracking_hours,
            $subtopicContent,
        );

        transaction($command);

        Alert::success("Han sido actualizadas las horas para el subtema");
        return redirect()->back();
    }
}
