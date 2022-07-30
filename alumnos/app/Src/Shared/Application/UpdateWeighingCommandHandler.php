<?php

namespace App\Src\Shared\Application;

use App\Src\Shared\Domain\CommandHandler;
use App\Src\Shared\Domain\InvalidWeighing;

class UpdateWeighingCommandHandler extends CommandHandler
{
    public function handle(UpdateWeighingCommand $command)
    {
        if($command->weighing > 10 || $command->weighing < 0){
            throw new InvalidWeighing();
        }

        $command->model->update([
            'weighing' => $command->weighing
        ]);
    }
}
