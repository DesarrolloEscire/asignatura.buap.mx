<?php

namespace App\Http\Controllers\Plannings\Topics\Hours;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\TopicContent;
use App\Models\Topic;
use App\Src\Plannings\Topics\Application\UpdateHoursCommand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Update extends Controller
{
    public function __invoke(Request $request, Planning $planning, Topic $topic)
    {
        $topicContent = TopicContent::firstOrCreate([
            'planning_id' => $planning->id,
            'topic_id' => $topic->id,
        ]);

        $command = new UpdateHoursCommand(
            $request->practical_hours,
            $request->theoretical_hours,
            $request->independent_hours,
            $request->tracking_hours,
            $topicContent,
        );

        transaction($command);

        Alert::success('Las horas han sido actualizadas.');
        return redirect()->back();
    }
}
