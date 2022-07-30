<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaeResponsible extends Model
{
    use HasFactory;

    protected $connection = 'mysql_basedatos';

    protected $table = "responsablesasig";

    public $timestamps = false;

    protected $fillable = [
        'PASW'
    ];

    public function user()
    {
        return $this->setConnection('pgsql')->belongsTo(
            User::class,
            'ID',
            'identifier'
        );
    }

    public function subject()
    {
        return $this->setConnection('pgsql')->belongsTo(
            Subject::class,
            'CLAVEASIG',
            'key'
        )->whereEducationalProgram($this->educationalProgram)
            ->whereAcademicUnit($this->academicUnit);
    }

    public function ofertaeTeacher()
    {
        return $this->hasOne(
            OfertaeTeacher::class,
            'ID',
            'ID'
        );
    }

    public function educationalProgram()
    {
        return $this->setConnection('pgsql')->belongsTo(
            EducationalProgram::class,
            'PE',
            'key'
        );
    }

    public function academicUnit()
    {
        return $this->setConnection('pgsql')->belongsTo(
            AcademicUnit::class,
            'CLAVEDEP',
            'key'
        );
    }

    public function getIdentifierAttribute()
    {
        return $this->ID;
    }

    public function getPasswordAttribute()
    {
        return $this->PASW;
    }

    public function getFullNameAttribute()
    {
        return $this->DOCENTE;
    }

    public function getEmailAttribute()
    {
        return $this->ofertaeTeacher ? $this->ofertaeTeacher->email : null;
    }

    public function subjects()
    {
        $keySubjects = self::where('ID', $this->identifier)
            ->get()
            ->pluck('CLAVEASIG')
            ->toArray();

        return Subject::whereIn('key', $keySubjects);
    }
}
