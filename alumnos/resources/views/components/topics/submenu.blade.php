@if ($topics)
<div class="collapse show mb-3" id="collapseExample">
    <div class="kt-card">
        <div class="card-body">
            @foreach ($topics as $currentTopic)
                <div>
                    <a href="{{ route('plannings.topics.show', [$planning, $currentTopic]) }}" class="{{ $activeTopic && $activeTopic->id == $currentTopic->id ? 'text-success font-weight-bold' : 'text-primary' }}">{{ $currentTopic->title }}</a>
                </div>
                <div class="divider"></div>
                @foreach ($currentTopic->subtopics()->orderBy('position')->get() as $currentSubtopic)
                    <div class="ml-4">
                        <a href="{{ route('plannings.subtopics.show', [$planning, $currentSubtopic]) }}"
                        class="{{ $activeSubtopic  && $activeSubtopic->id == $currentSubtopic->id ? 'text-success font-weight-bold' : 'text-primary' }}">{{ $currentSubtopic->title }}</a>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endif