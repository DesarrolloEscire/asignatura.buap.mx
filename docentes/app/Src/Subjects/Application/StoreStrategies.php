<?php

declare(strict_types=1);

namespace App\Src\Subjects\Application;

use App\Models\Strategy;
use App\Models\Subject;

class StoreStrategies
{
    public function handle(array $strategyDescriptions, Subject $subject)
    {
        $newStrategies = collect($strategyDescriptions)
            ->map(function ($strategyDescription) {
                return Strategy::firstOrCreate([
                    'description' => $strategyDescription
                ]);
            });

        $subject
            ->strategies()
            ->sync($newStrategies->pluck('id'));
    }
}
