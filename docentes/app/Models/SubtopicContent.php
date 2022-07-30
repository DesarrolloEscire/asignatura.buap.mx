<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubtopicContent extends Model
{
    use HasFactory;

    protected $table = "subtopic_contents";

    public $timestamps = false;

    protected $fillable = [
        "planning_id",
        "subtopic_id",
        "theoretical_hours",
        "practical_hours",
        "independent_hours",
        "tracking_hours",
        "activity",
        "weighing",
        "materials",
        "security",
        "equipment",
    ];

    public function competenceUnits()
    {
        return $this->belongsToMany(
            CompetenceUnit::class,
            'competence_unit__subtopic_content',
            'subtopic_content_id',
            'competence_unit_id',
        );
    }

    public function instruments()
    {
        return $this->belongsToMany(
            Instrument::class,
            'instrument__subtopic_content',
            'subtopic_content_id',
            'instrument_id'
        );
    }

    public function planning()
    {
        return $this->belongsTo(
            Planning::class,
            'planning_id'
        );
    }

    public function subtopic()
    {
        return $this->belongsTo(
            Subtopic::class,
            'subtopic_id',
        );
    }

    public function scopeWherePlanning($query, Planning $planning)
    {
        return $query->where('planning_id', $planning->id);
    }

    public function scopeWhereTopic($query, Topic $topic)
    {
        return $query->whereHas('subtopic', function ($query) use ($topic) {
            return $query->whereHas('topic', function ($query) use ($topic) {
                return $query->where('topic.id', $topic->id);
            });
        });
    }

    public function getTheoreticalMaximumPossibleHoursAttribute()
    {
        return $this->topicContent()->first()->missing_theoretical_hours + $this->theoretical_hours;
    }

    public function getPracticalMaximumPossibleHoursAttribute()
    {
        return $this->topicContent()->first()->missing_practical_hours + $this->practical_hours;
    }

    public function canUpdateTheoreticalHours(int $newTheoreticalHours)
    {
        return $this->theoretical_maximum_possible_hours >= $newTheoreticalHours;
    }

    public function canUpdatePracticalHours(int $newPracticalHours)
    {
        return $this->practical_maximum_possible_hours >= $newPracticalHours;
    }

    public function topicContent()
    {
        return $this
            ->planning
            ->topicContents()
            ->whereSubtopic($this->subtopic);
    }

    /*
    | -------------------------------------------
    | Extra methods
    | -------------------------------------------
    |
    */

    public function hasCompetenceUnit(CompetenceUnit $competenceUnit): bool
    {
        return $this
            ->competenceUnits()
            ->where('competence_units.id', $competenceUnit->id)
            ->exists();
    }

    public function hasInstrument(string $instrumentDescription)
    {
        return $this
            ->instruments()
            ->where('instruments.description', $instrumentDescription)
            ->exists();
    }

    public function getExtraInstrumentAttribute()
    {
        return $this
            ->instruments()
            ->whereNotIn('description', instruments())
            ->first();
    }
}
