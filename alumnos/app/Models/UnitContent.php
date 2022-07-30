<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitContent extends Model
{
    use HasFactory;

    protected $table = "unit_contents";

    public $timestamps = false;

    protected $fillable = [
        "planning_id",
        "unit_id",
        "weighing",
    ];

    public function competences()
    {
        return $this->belongsToMany(
            Competence::class,
            'competence__unit_content',
            'unit_content_id',
            'competence_id'
        );
    }

    public function evidences()
    {
        return $this->belongsToMany(
            Evidence::class,
            'evidence__unit_content',
            'unit_content_id',
            'evidence_id'
        );
    }

    public function instruments()
    {
        return $this->belongsToMany(
            Instrument::class,
            'instrument__unit_content',
            'unit_content_id',
            'instrument_id'
        );
    }

    public function resources()
    {
        return $this->belongsToMany(
            Resource::class,
            'resource__unit_content',
            'unit_content_id',
            'resource_id'
        );
    }

    public function strategies()
    {
        return $this->belongsToMany(
            Strategy::class,
            'strategy__unit_content',
            'unit_content_id',
            'strategy_id'
        );
    }

    /*
    | -------------------------------------------
    | Calculated attributes
    | -------------------------------------------
    |
    */

    public function getExtraEvidenceAttribute()
    {
        return $this
            ->evidences()
            ->whereNotIn('description', evidences())
            ->first();
    }

    public function getExtraInstrumentAttribute()
    {
        return $this
            ->instruments()
            ->whereNotIn('description', instruments())
            ->first();
    }

    /*
    | -------------------------------------------
    | Extra methods
    | -------------------------------------------
    |
    */

    public function hasCompetence(Competence $competence)
    {
        return $this
            ->competences()
            ->where('competences.id', $competence->id)
            ->exists();
    }

    public function hasInstrument(string $instrumentDescription)
    {
        return $this
            ->instruments()
            ->where('instruments.description', $instrumentDescription)
            ->exists();
    }

    public function hasStrategy(string $strategyDescription)
    {
        return $this
            ->strategies()
            ->where('strategies.description', $strategyDescription)
            ->exists();
    }

    public function hasResource(string $resourceDescription): bool
    {
        return $this
            ->resources()
            ->where('resources.description', $resourceDescription)
            ->exists();
    }

    public function hasEvidence(string $evidenceDescription)
    {
        return $this
            ->evidences()
            ->where('evidences.description', $evidenceDescription)
            ->exists();
    }
}
