<?php

namespace App\Src\Subtopics\Application;

use App\Src\Shared\Domain\Command;
use App\Src\Shared\Domain\CommandHandler;
use App\Src\Shared\Domain\Exceptions\HoursExcedeed;

class UpdateHoursCommandHandler extends CommandHandler
{
    public function handle(UpdateHoursCommand $command)
    {
        $this->validatePracticalHours($command);
        $this->validateTheoreticalHours($command);

        $command->subtopicContent->update([
            'theoretical_hours' => $command->theoreticalHours,
            'practical_hours' => $command->practicalHours,
            'independent_hours' => $command->independentHours,
            'tracking_hours' => $command->trackingHours,
        ]);
    }

    private function validateTheoreticalHours(Command $command)
    {
        $topicContent = $command
            ->subtopicContent
            ->topicContent()
            ->first();

        if (!$command->subtopicContent->canUpdateTheoreticalHours($command->theoreticalHours)) {
            throw new HoursExcedeed("Superaste las " . $topicContent->theoretical_hours . " horas permitidas");
        }
    }

    private function validatePracticalHours(Command $command)
    {
        $topicContent = $command
            ->subtopicContent
            ->topicContent()
            ->first();

        if (!$command->subtopicContent->canUpdatePracticalHours($command->practicalHours)) {
            throw new HoursExcedeed("Superaste las " . $topicContent->practical_hours . " horas permitidas");
        }
    }
}
