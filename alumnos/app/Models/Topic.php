<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = "topics";

    protected $fillable = [
        "position",
        "title",
        "unit_id",
    ];

    /*
    | -------------------------------------------
    | Relations
    | -------------------------------------------
    |
    */

    public function subtopics()
    {
        return $this->hasMany(
            Subtopic::class
        );
    }

    public function unit()
    {
        return $this->belongsTo(
            Unit::class,
        );
    }

    public function topicContents()
    {
        return $this->hasMany(
            TopicContent::class,
            'topic_id',
            'id'
        );
    }

    /*
    | -------------------------------------------
    | Calcultated attributes
    | -------------------------------------------
    |
    */

    public function getNextEmptyPositionAttribute(): int
    {
        $lastSubtopic = $this->subtopics()->orderBy('position', 'DESC')->first();
        return $lastSubtopic
            ? $lastSubtopic->position + 1
            : 0;
    }

    /*
    | -------------------------------------------
    | Extra methods
    | -------------------------------------------
    |
    */
}
