<?php

namespace App\Http\Livewire\Plannings\Topics;

use App\Models\Planning;
use App\Models\Subject;
use App\Models\TopicContent;
use App\Models\Topic;
use Livewire\Component;

class Show extends Component
{
    public $competenceUnits;
    public $topicContent;
    public $strategies;
    public $resources;

    public function mount(Planning $planning, Topic $topic)
    {
        $this->topicContent = TopicContent::firstOrCreate([
            'planning_id' => $planning->id,
            'topic_id' => $topic->id,
        ]);

        $this->competenceUnits = $planning
            ->subject
            ->competenceUnits;
    }

    public function render()
    {
        return view('livewire.plannings.topics.show');
    }
}
