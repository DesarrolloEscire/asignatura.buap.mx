<?php

namespace App\Src\Subtopics\Application;

use App\Models\SubtopicContent;
use App\Src\Shared\Domain\Command;
use App\Src\Shared\Domain\CommandHandler;

class UpdateHoursCommand extends Command
{
    public $theoreticalHours;
    public $practicalHours;
    public $independentHours;
    public $subtopicContent;
    public $trackingHours;

    public function __construct(int $theoreticalHours, int $practicalHours, int $independentHours, int $trackingHours, SubtopicContent $subtopicContent)
    {
        $this->theoreticalHours = $theoreticalHours;
        $this->practicalHours = $practicalHours;
        $this->independentHours = $independentHours;
        $this->subtopicContent = $subtopicContent;
        $this->trackingHours = $trackingHours;
    }

    public function commandHandler(): CommandHandler
    {
        return new UpdateHoursCommandHandler;
    }
}
