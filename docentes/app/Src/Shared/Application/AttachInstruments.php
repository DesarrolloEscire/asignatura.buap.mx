<?php

declare(strict_types=1);

namespace App\Src\Shared\Application;

use App\Models\Instrument;
use Illuminate\Database\Eloquent\Model;

class AttachInstruments
{
    public function handle(array $instrumentDescriptions, Model $model)
    {
        $newInstrument = collect($instrumentDescriptions)
            ->map(function ($instrumentDescriptions) {
                return Instrument::firstOrCreate([
                    'description' => $instrumentDescriptions
                ]);
            });

        $model
            ->instruments()
            ->sync($newInstrument->pluck('id'));
    }
}
