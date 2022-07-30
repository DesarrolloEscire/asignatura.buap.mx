<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name'
    ];

    public function educationalPrograms()
    {
        return $this->belongsToMany(
            EducationalProgram::class,
            'area__educational_program',
            'area_id',
            'educational_program_id'
        );
    }

    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'subject__area',
            'area_id',
            'subject_id'
        );
    }
}
