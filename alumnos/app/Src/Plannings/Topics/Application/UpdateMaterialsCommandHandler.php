<?php

namespace App\Src\Plannings\Topics\Application;

use App\Src\Shared\Domain\CommandHandler;

class UpdateMaterialsCommandHandler extends CommandHandler
{
    public function handle(UpdateMaterialsCommand $updateMaterialsCommand)
    {
        $updateMaterialsCommand->model->update([
            'security' => $updateMaterialsCommand->security,
            'materials' => $updateMaterialsCommand->materials,
            'equipment' => $updateMaterialsCommand->equipment,
        ]);
    }
}
