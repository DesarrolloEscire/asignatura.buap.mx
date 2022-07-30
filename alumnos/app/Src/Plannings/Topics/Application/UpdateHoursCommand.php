<?php

namespace App\Src\Plannings\Topics\Application;

use App\Models\Planning;
use App\Models\TopicContent;
use App\Models\Topic;
use App\Src\Shared\Domain\Command;
use App\Src\Shared\Domain\CommandHandler;

class UpdateHoursCommand extends Command
{
    public $practicalHours;
    public $theoreticalHours;
    public $independentHours;
    public $trackingHours;
    public $topicContent;

    public function __construct(int $practicalHours, int $theoreticalHours, int $independentHours, int $trackingHours, TopicContent $topicContent)
    {
        $this->practicalHours = $practicalHours;
        $this->theoreticalHours = $theoreticalHours;
        $this->independentHours = $independentHours;
        $this->trackingHours = $trackingHours;
        $this->topicContent = $topicContent;
    }

    public function commandHandler() : CommandHandler
    {
        return new UpdateHoursCommandHandler;
    }
}
