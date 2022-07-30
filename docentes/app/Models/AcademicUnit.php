<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicUnit extends Model
{
    use HasFactory;

    protected $table = "academic_units";

    protected $fillable = [
        "name",
        "key"
    ];

    public $timestamps = false;

    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'academic_unit__subject',
            'academic_unit_id',
            'subject_id',
        );
    }

    public function teachers()
    {
        return $this->belongsToMany(
            Teacher::class,
            'academic_unit__teacher',
            'academic_unit_id',
            'teacher_id'
        );
    }

    public function educationalPrograms()
    {
        return $this->belongsToMany(
            EducationalProgram::class,
            'academic_unit__educational_program',
            'academic_unit_id',
            'educational_program_id',
        );
    }
}
