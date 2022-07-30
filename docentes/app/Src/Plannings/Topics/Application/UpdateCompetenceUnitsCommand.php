<?php

namespace App\Src\Plannings\Topics\Application;

use App\Src\Shared\Domain\Command;
use App\Src\Shared\Domain\CommandHandler;
use Illuminate\Database\Eloquent\Model;

class UpdateCompetenceUnitsCommand extends Command
{
    public $model;
    public $competence_unit_ids;

    public function __construct(array $competence_unit_ids = [], Model $model)
    {
        $this->competence_unit_ids = $competence_unit_ids;
        $this->model = $model;
    }

    public function commandHandler(): CommandHandler
    {
        return new UpdateCompetenceUnitsCommandHandler;
    }
}
