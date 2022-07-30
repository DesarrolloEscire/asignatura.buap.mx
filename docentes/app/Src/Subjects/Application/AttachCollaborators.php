<?php

namespace App\Src\Subjects\Application;

use App\Models\Subject;
use App\Src\Subjects\Domain\NumberOfCollaboratorsExcedeed;
use Illuminate\Http\Request;

class AttachCollaborators
{
    public function handle(Subject $subject, Request $request)
    {
        if( count($request->teacher_ids ?? []) > Subject::MAXIMUM_NUMBER_OF_COLLABORATORS ){
            throw new NumberOfCollaboratorsExcedeed();
        }

        $subject->collaborators()->sync($request->teacher_ids);
    }
}
