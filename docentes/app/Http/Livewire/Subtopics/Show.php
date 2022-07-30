<?php

namespace App\Http\Livewire\Subtopics;

use App\Models\Planning;
use App\Models\SubtopicContent;
use App\Models\Subtopic;
use App\Models\TopicContent;
use Livewire\Component;

class Show extends Component
{
    public $competenceUnits;
    public $subtopicContent;
    public $topicContent;
    public $strategies;
    public $resources;

    public function mount(Planning $planning, Subtopic $subtopic)
    {

        $this->subtopicContent = SubtopicContent::firstOrCreate([
            'planning_id' => $planning->id,
            'subtopic_id' => $subtopic->id,
        ]);

        $this->topicContent = TopicContent::firstOrCreate([
            'planning_id' => $planning->id,
            'topic_id' => $this->subtopicContent->subtopic->topic->id
        ]);

        $this->competenceUnits = $planning
            ->subject
            ->competenceUnits;
    }

    public function render()
    {
        return view('livewire.subtopics.show');
    }
}
