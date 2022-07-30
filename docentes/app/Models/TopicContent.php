<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicContent extends Model
{
    use HasFactory;

    protected $table = "topic_contents";

    public $timestamps = false;

    protected $fillable = [
        "planning_id",
        "topic_id",
        "activity",
        "equipment",
        "independent_hours",
        "materials",
        "practical_hours",
        "security",
        "theoretical_hours",
        "tracking_hours",
        "weighing",
    ];

    public function competenceUnits()
    {
        return $this->belongsToMany(
            CompetenceUnit::class,
            'competence_unit__topic_content',
            'topic_content_id',
            'competence_unit_id',
        );
    }

    public function planning()
    {
        return $this->belongsTo(
            Planning::class,
            'planning_id',
        );
    }

    public function topic()
    {
        return $this->belongsTo(
            Topic::class,
            'topic_id',
        );
    }

    public function scopeWherePlanning($query, Planning $planning)
    {
        return $query->where('planning_id', $planning->id);
    }

    public function scopeWhereSubtopic($query, Subtopic $subtopic)
    {
        return $query->whereHas('topic', function ($query) use ($subtopic) {
            return $query->whereHas('subtopics', function ($query) use ($subtopic) {
                return $query->where('subtopics.id', $subtopic->id);
            });
        });
    }

    public function scopeWhereUnit($query, Unit $unit)
    {
        return $query->whereHas('topic', function ($query) use ($unit) {
            return $query->whereHas('unit', function ($query) use ($unit) {
                return $query->where('units.id', $unit->id);
            });
        });
    }

    public function getHoursAttribute()
    {
        return $this->theoretical_hours + $this->practical_hours;
    }

    /**
     * Get the hours that the topicContent needs to be completeed
     * 
     */
    public function getMissingTheoreticalHoursAttribute()
    {
        return $this->theoretical_hours - $this->theoretical_hours_applied;
    }

    /**
     * Get the hours that the topicContent needs to be completeed
     * 
     */
    public function getMissingPracticalHoursAttribute()
    {
        return $this->practical_hours - $this->practical_hours_applied;
    }

    public function getTheoreticalHoursAppliedAttribute()
    {
        return $this->planning->subtopicContents()->sum('theoretical_hours');
    }

    public function getPracticalHoursAppliedAttribute()
    {
        return $this->planning->subtopicContents()->sum('practical_hours');
    }

    /*
    | -------------------------------------------
    | Extra methods
    | -------------------------------------------
    |
    */

    public function hasCompetenceUnit(CompetenceUnit $competenceUnit)
    {
        return $this
            ->competenceUnits()
            ->where('competence_units.id', $competenceUnit->id)
            ->exists();
    }

    public function canUpdateTheoreticalHours(int $newTheoreticalHours)
    {
        return $this->planning->subject->theoretical_hours >= $this->planning->theoretical_hours + $newTheoreticalHours - $this->theoretical_hours;
    }

    public function canUpdatePracticalHours(int $newPracticalHours)
    {
        return $this->planning->subject->practical_hours >= $this->planning->practical_hours + $newPracticalHours - $this->practical_hours;
    }
}
