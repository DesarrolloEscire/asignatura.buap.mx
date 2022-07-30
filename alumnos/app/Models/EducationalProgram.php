<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalProgram extends Model
{
    use HasFactory;

    protected $table = "educational_programs";

    protected $fillable = [
        "name",
        "key",
        "modality"
    ];

    public $timestamps = false;

    public function academicUnits()
    {
        return $this->belongsToMany(
            AcademicUnit::class,
            'academic_unit__educational_program',
            'educational_program_id',
            'academic_unit_id'
        );
    }

    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'educational_program__subject',
            'educational_program_id',
            'subject_id'
        );
    }

    public function competences()
    {
        return $this->belongsToMany(
            Competence::class,
            'competence__educational_program',
            'educational_program_id',
            'competence_id',
        );
    }

    public function scopeWhereAcademicUnit($query, AcademicUnit $academicUnit)
    {
        return $query->whereHas('academicUnits', function ($query) use ($academicUnit) {
            return $query->where('academic_units.id', $academicUnit->id);
        });
    }

    public function scopeWhereSubject($query, Subject $subject)
    {
        return $query->whereHas('subjects', function ($query) use ($subject) {
            return $query->where('subjects.id', $subject->id);
        });
    }
}
