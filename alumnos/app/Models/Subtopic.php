<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtopic extends Model
{
    use HasFactory;

    protected $table = "subtopics";

    protected $fillable = [
        "topic_id",
        "title",
        "url",
        "position",
    ];

    public function topic()
    {
        return $this->belongsTo(
            Topic::class
        );
    }

    public function subtopicContents()
    {
        return $this->hasMany(
            SubtopicContent::class,
            'subtopic_id',
            'id'
        );
    }

    public function moveToTheLastPosition(Topic $topic)
    {
        $this->update([
            'position' => $topic->next_empty_position,
            'topic_id' => $topic->id
        ]);
    }

    /**
     * Move the goal one position back
     * 
     */
    public function pushBack()
    {
        $previousSubtopic = $this->previous_subtopic;
        if (!$previousSubtopic) {
            return;
        }

        $newPosition = $this->previous_subtopic->position;
        $currentPosition = $this->position;

        $this->update([
            'position' => $newPosition
        ]);

        $previousSubtopic->update([
            'position' => $currentPosition
        ]);
    }

    public function getpreviousSubtopicAttribute()
    {
        return Subtopic::where('position', '<', $this->position)
            ->where('topic_id', $this->topic_id)
            ->orderBy('position', 'desc')
            ->first();
    }
}
