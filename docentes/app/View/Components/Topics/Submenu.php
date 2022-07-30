<?php

namespace App\View\Components\Topics;

use App\Models\Planning;
use App\Models\Subtopic;
use App\Models\Topic;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Submenu extends Component
{
    public $topics;
    public $planning;
    public $activeTopic;
    public $activeSubtopic;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( Planning $planning, Collection $topics, ?Topic $activeTopic = null, ?Subtopic $activeSubtopic  = null)
    {
        $this->topics = $topics;
        $this->planning = $planning;
        $this->activeTopic = $activeTopic;
        $this->activeSubtopic  = $activeSubtopic ;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.topics.submenu');
    }
}
