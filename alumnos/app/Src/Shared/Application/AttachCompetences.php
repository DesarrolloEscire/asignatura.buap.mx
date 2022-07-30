<?php

namespace App\Src\Shared\Application;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AttachCompetences
{
    public function handle(Request $request, Model $model)
    {
        $model->competences()->sync($request->competence_ids);
    }
}
