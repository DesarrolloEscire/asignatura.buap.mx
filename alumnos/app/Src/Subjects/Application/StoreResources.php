<?php

namespace App\Src\Subjects\Application;

use App\Models\Resource;
use App\Models\Subject;

class StoreResources
{
    public function handle(array $resourceDescriptions, Subject $subject)
    {

        $newResources = collect($resourceDescriptions)->map(function ($resourceDescription) {
            return Resource::firstOrCreate([
                'description' => $resourceDescription
            ]);
        });

        $subject
            ->resources()
            ->sync($newResources->pluck('id'));
    }
}
