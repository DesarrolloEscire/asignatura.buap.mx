<?php

namespace App\Http\Controllers\Subtopics\Activity;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\SubtopicContent;
use App\Models\Subtopic;
use App\Src\Shared\Application\UpdateActivityCommand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Update extends Controller
{
    public function __invoke(Request $request, Planning $planning, Subtopic $subtopic)
    {
        $subtopicContent = SubtopicContent::firstOrCreate([
            'planning_id' => $planning->id,
            'subtopic_id' => $subtopic->id
        ]);

        $command = new UpdateActivityCommand(
            $request->activity,
            $subtopicContent
        );

        transaction($command);

        Alert::success('Actividad actualizada');
        return redirect()->back();
    }
}
