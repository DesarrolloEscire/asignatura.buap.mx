<?php

namespace App\Src\Plannings\Topics\Application;

use App\Models\TopicContent;
use App\Src\Shared\Domain\Command;
use App\Src\Shared\Domain\CommandHandler;
use Illuminate\Database\Eloquent\Model;

class UpdateMaterialsCommand extends Command
{

    public $materials;
    public $equipment;
    public $security;
    public $model;

    public function __construct(
        string $materials = null,
        string $equipment = null,
        string $security = null,
        Model $model
    ) {
        $this->materials = $materials;
        $this->equipment = $equipment;
        $this->security = $security;
        $this->model = $model;
    }

    public function commandHandler(): CommandHandler
    {
        return new UpdateMaterialsCommandHandler;
    }
}
