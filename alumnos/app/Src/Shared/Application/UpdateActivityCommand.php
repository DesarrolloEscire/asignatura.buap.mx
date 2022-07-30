<?php

namespace App\Src\Shared\Application;

use App\Models\Topic;
use App\Src\Shared\Domain\Command;
use App\Src\Shared\Domain\CommandHandler;
use Illuminate\Database\Eloquent\Model;

class UpdateActivityCommand extends Command
{

    public $activity;
    public $model;

    public function __construct(?string $activity = null, Model $model)
    {
        $this->activity = $activity;
        $this->model = $model;
    }

    public function commandHandler(): CommandHandler
    {
        return new UpdateActivityCommandHandler();
    }
}
