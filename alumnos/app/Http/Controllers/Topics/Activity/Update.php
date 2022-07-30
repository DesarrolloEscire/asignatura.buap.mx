<?php

namespace App\Http\Controllers\Topics\Activity;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Planning;
use App\Models\TopicContent;
use App\Src\Shared\Application\UpdateActivityCommand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Update extends Controller
{
    public function __invoke(Request $request, Planning $planning, Topic $topic)
    {
        $topicContent = TopicContent::firstOrCreate([
            'planning_id' => $planning->id,
            'topic_id' => $topic->id
        ]);

        $command = new UpdateActivityCommand(
            $request->activity,
            $topicContent
        );
        
        transaction($command);
        
        Alert::success('Actividad actualizada');
        return redirect()->back();
    }
}
