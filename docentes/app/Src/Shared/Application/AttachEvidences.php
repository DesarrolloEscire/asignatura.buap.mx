<?php

declare(strict_types=1);

namespace App\Src\Shared\Application;

use App\Models\Evidence;
use Illuminate\Database\Eloquent\Model;

class AttachEvidences
{
    public function handle(array $evidenceDescriptions, Model $model)
    {
        $newEvidences = collect($evidenceDescriptions)
            ->map(function ($evidenceDescriptions) {
                return Evidence::firstOrCreate([
                    'description' => $evidenceDescriptions
                ]);
            });

        $model
            ->evidences()
            ->sync($newEvidences->pluck('id'));
    }
}
