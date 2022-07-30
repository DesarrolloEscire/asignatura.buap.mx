<?php

namespace App\Src\Subjects\Application;

use App\Models\Axis;
use App\Models\Subject;

class StoreAxes
{

    public function handle(array $axisDecriptions, Subject $subject)
    {
        $newAxes = collect($axisDecriptions)->map( function($axisDecription){
            return Axis::firstOrCreate([
                'description' => $axisDecription
            ]);
        } );

        $subject->axes()->sync($newAxes->pluck('id'));
    }
}
