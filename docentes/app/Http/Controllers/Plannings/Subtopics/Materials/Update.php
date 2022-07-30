<?php

namespace App\Http\Controllers\Plannings\Subtopics\Materials;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Models\Subtopic;
use App\Models\SubtopicContent;
use App\Src\Plannings\Topics\Application\UpdateMaterialsCommand;
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

        $command = new UpdateMaterialsCommand(
            $request->materials,
            $request->equipment,
            $request->security,
            $subtopicContent,
        );

        transaction($command);

        Alert::success("Información actualizada", "materiales, equipo y seguridad almacenados");
        return redirect()->back();
    }
}
