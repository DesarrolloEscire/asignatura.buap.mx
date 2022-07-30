<?php

namespace App\Http\Controllers\Topics\Materials;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Topic;
use App\Models\TopicContent;
use App\Src\Plannings\Topics\Application\UpdateMaterialsCommand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Update extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Planning $planning, Topic $topic)
    {
        $topicContent = TopicContent::firstOrCreate([
            'planning_id' => $planning->id,
            'topic_id' => $topic->id,
        ]);

        $command = new UpdateMaterialsCommand(
            $request->materials,
            $request->equipment,
            $request->security,
            $topicContent,
        );

        transaction($command);

        Alert::success("Información actualizada", "materiales, equipo y seguridad almacenados");
        return redirect()->back();
    }
}
