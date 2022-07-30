<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    const GENERIC_TYPE = 'genérica';
    const SPECIFIC_TYPE = 'específica';

    protected $fillable = [
        "description",
        "type"
    ];

    public function competenceUnits()
    {
        return $this->belongsToMany(
            CompetenceUnit::class,
            'competence__competence_unit',
            'competence_id',
            'competence_unit_id',
        );
    }

    public function educationalPrograms()
    {
        return $this->belongsToMany(
            EducationalProgram::class,
            'competence__educational_program',
            'competence_id',
            'educational_program_id'
        );
    }

    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'competence__subject',
            'competence_id',
            'subject_id',
        );
    }

    public function scopeSpecific($query)
    {
        return $query->where('type', self::SPECIFIC_TYPE);
    }

    public function scopeGeneric($query)
    {
        return $query->where('type', self::GENERIC_TYPE);
    }

    public function scopeWhereEducationalProgram($query, EducationalProgram $educationalProgram)
    {
        return $query->whereHas('educationalPrograms', function ($query) use ($educationalProgram) {
            return $query->where('educational_programs.id', $educationalProgram->id);
        });
    }

    public function scopeWhereEducationalProgramIn($query, $educationalPrograms)
    {
        return $query->whereHas('educationalPrograms', function ($query) use ($educationalPrograms) {
            return $query->whereIn('educational_programs.id', $educationalPrograms->pluck('id'));
        });
    }
}
