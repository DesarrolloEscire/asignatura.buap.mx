<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";

    public $timestamps = false;

    protected $fillable = [
        "name",
        "email",
        "identifier"
    ];

    public function asUser()
    {
        return $this->hasOne(
            User::class,
            'identifier',
            'identifier'
        );
    }

    public function academicUnits()
    {
        return $this->belongsToMany(
            AcademicUnit::class,
            'academic_unit__student',
            'student_id',
            'academic_unit_id'
        );
    }

    public function scopeWhereAcademicUnit($query, AcademicUnit $academicUnit)
    {
        return $query->whereHas('academicUnits', function ($query) use ($academicUnit) {
            return $query->where('academic_units.id', $academicUnit->id);
        });
    }

    public function scopeWhereIdentifier($query, string $identifier)
    {
        return $query->where('identifier', $identifier);
    }
}
