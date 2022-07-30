<?php

namespace App\Src\Plannings\Topics\Application;

use App\Src\Shared\Domain\CommandHandler;

class UpdateCompetenceUnitsCommandHandler extends CommandHandler
{
    public function handle(UpdateCompetenceUnitsCommand $command)
    {
        $command
            ->model
            ->competenceUnits()
            ->sync($command->competence_unit_ids);
    }
}
