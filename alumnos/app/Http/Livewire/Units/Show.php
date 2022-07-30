<?php

namespace App\Http\Livewire\Units;

use App\Models\Bibliography;
use App\Models\Unit;
use App\Models\Subtopic;
use App\Models\Topic;
use Livewire\Component;

class Show extends Component
{
    public Unit $unit;

    public function mount(Unit $unit)
    {
        $this->unit = $this->unit($unit->id);
    }

    private function unit(int $unitId): Unit
    {
        return Unit::where('id', $unitId)
            ->with(['topics' => function ($query) {
                $query->with(['subtopics' => function ($query) {
                    $query->orderBy('subtopics.position');
                }])->orderBy('topics.position');
            }])
            ->with(['bibliographies'])
            ->first();
    }

    public function render()
    {
        return view('livewire.units.show');
    }

    public function createTopic(string $title)
    {
        $newTopic = Topic::create([
            'title' => $title,
            'unit_id' => $this->unit->id,
            'position' => $this->unit->next_empty_position,
        ]);

        return $newTopic->toJson();
    }

    public function deleteTopic(int $topicId)
    {
        $topic = Topic::find($topicId);
        $topic->subtopics()->delete();
        $topic->delete();
        return $topicId;
    }

    public function createSubtopic(int $topicId, int $minutes, string $title): string
    {
        $topic = Topic::find($topicId);

        $subtopic = $topic->subtopics()->create([
            'title' => $title,
            'minutes' => $minutes,
            'url' => 'http://url/',
            'position' => $topic->next_empty_position
        ]);

        return $subtopic->toJson();
    }

    public function changeTopicPositions(array $topicIdsNewPosition): void
    {
        foreach ($topicIdsNewPosition as $position => $topicId) {
            Topic::where('id', $topicId)->update([
                'position' => $position
            ]);
        }
    }

    public function findSubtopic(int $subtopicId)
    {
        return Subtopic::find($subtopicId)->toJson();
    }

    public function topics()
    {
        return $this->unit($this->unit->id)->topics->toJson();
    }

    public function moveSubtopic(int $subtopicId, int $topicId, int $newPosition)
    {
        $subtopic = Subtopic::find($subtopicId);
        $topic = Topic::find($topicId);


        $subtopic->moveToTheLastPosition(
            $topic
        );

        foreach ($topic->subtopics()->orderBy('position')->get() as $key => $otherSubtopic) {
            $otherSubtopic->update([
                'position' => $key
            ]);
        }


        while ($subtopic->position > $newPosition) {
            $subtopic->pushBack();
        }

        foreach ($topic->subtopics()->orderBy('position')->get() as $key => $otherSubtopic) {
            $otherSubtopic->update([
                'position' => $key
            ]);
        }
    }

    public function deleteSubtopic(int $subtopicId)
    {
        Subtopic::where('id', $subtopicId)->delete();
        return $this->unit($this->unit->id)->toJson();
    }

    public function unitUpdated()
    {
        $unit = $this->unit($this->unit->id);
        return $unit->toJson();
    }

    public function copySubtopic(int $subtopicId)
    {
        $subtopicToCopy = Subtopic::find($subtopicId);

        $newSubtopic = Subtopic::create([
            'title' => $subtopicToCopy->title,
            'url' => $subtopicToCopy->url,
            'minutes' => $subtopicToCopy->minutes,
            'position' => $subtopicToCopy->position,
            'topic_id' => $subtopicToCopy->topic_id
        ]);


        $this->moveSubtopic($newSubtopic->id, $newSubtopic->topic_id, $newSubtopic->position + 1);
    }

    public function createBibliography(string $bibliographyContent)
    {
        $this->unit->bibliographies()->create([
            'content' => $bibliographyContent
        ]);
    }

    public function deleteBibliography(int $bibliographyId)
    {
        Bibliography::find($bibliographyId)->delete();
    }
}
