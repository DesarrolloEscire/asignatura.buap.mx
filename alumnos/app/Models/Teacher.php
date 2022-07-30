<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory, Searchable;

    protected $table = "teachers";

    public $timestamps = false;
    
    protected $fillable = [
        "name",
        "email",
        "identifier"
    ];


    public function academicUnits()
    {
        return $this->belongsToMany(
            AcademicUnit::class,
            'academic_unit__teacher',
            'teacher_id',
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
