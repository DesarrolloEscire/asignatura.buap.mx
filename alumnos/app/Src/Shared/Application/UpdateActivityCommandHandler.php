<?php

namespace App\Src\Shared\Application;

use App\Src\Shared\Domain\CommandHandler;

class UpdateActivityCommandHandler extends CommandHandler
{
    public function handle(UpdateActivityCommand $command)
    {
        $command->model->update([
            'activity' => $command->activity
        ]);
    }
}
