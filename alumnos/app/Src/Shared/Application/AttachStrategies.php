<?php

declare(strict_types=1);

namespace App\Src\Shared\Application;

use App\Models\Strategy;
use Illuminate\Database\Eloquent\Model;

class AttachStrategies
{
    public function handle(array $strategyDescriptions, Model $model)
    {
        $newStrategies = collect($strategyDescriptions)
            ->map(function ($strategyDescription) {
                return Strategy::firstOrCreate([
                    'description' => $strategyDescription
                ]);
            });

        $model
            ->strategies()
            ->sync($newStrategies->pluck('id'));
    }
}
