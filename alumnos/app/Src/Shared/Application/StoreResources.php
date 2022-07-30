<?php

namespace App\Src\Shared\Application;

use App\Models\Resource;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class StoreResources
{
    public function handle(array $resourceDescriptions, Model $model)
    {
        $newResources = collect($resourceDescriptions)->map(function ($resourceDescription) {
            return Resource::firstOrCreate([
                'description' => $resourceDescription
            ]);
        });

        $model
            ->resources()
            ->sync($newResources->pluck('id'));
    }
}
