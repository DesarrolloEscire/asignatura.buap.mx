<?php

namespace App\Src\Plannings\Topics\Application;

use App\Models\Planning;
use App\Models\TopicContent;
use App\Src\Shared\Domain\Command;
use App\Src\Shared\Domain\CommandHandler;
use App\Src\Shared\Domain\Exceptions\HoursExcedeed;

class UpdateHoursCommandHandler extends CommandHandler
{
    public function handle(UpdateHoursCommand $command)
    {
        $topicContent = TopicContent::firstOrCreate([
            'planning_id' => $command->topicContent->planning->id,
            'topic_id' => $command->topicContent->topic->id,
        ]);

        $this->validatePracticalHours($command);
        $this->validateTheoreticalHours($command);

        $topicContent->update([
            'theoretical_hours' => $command->theoreticalHours,
            'practical_hours' => $command->practicalHours,
            'independent_hours' => $command->independentHours,
            'tracking_hours' => $command->trackingHours
        ]);

    }

    private function validateTheoreticalHours(Command $command)
    {
        if (!$command->topicContent->canUpdateTheoreticalHours($command->theoreticalHours)) {
            throw new HoursExcedeed("Superaste las " . $command->topicContent->planning->subject->theoretical_hours . " horas asignadas al tema.");
        }
    }

    private function validatePracticalHours(Command $command)
    {
        if (!$command->topicContent->canUpdatePracticalHours($command->practicalHours)) {
            throw new HoursExcedeed("Superaste las " . $command->topicContent->planning->subject->practical_hours . " horas asignadas al tema.");
        }
    }
}
