<?php

namespace App\Src\Shared\Application;

use App\Src\Shared\Domain\Command;
use App\Src\Shared\Domain\CommandHandler;
use Illuminate\Database\Eloquent\Model;

class UpdateWeighingCommand extends Command
{

    public $weighing;
    public $model;

    public function __construct(float $weighing, Model $model)
    {
        $this->weighing = $weighing;
        $this->model = $model;
    }

    public function commandHandler(): CommandHandler
    {
        return new UpdateWeighingCommandHandler;
    }
}
