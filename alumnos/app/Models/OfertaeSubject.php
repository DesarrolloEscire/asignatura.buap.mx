<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaeSubject extends Model
{
    use HasFactory;

    const FACTOR_HOURS_PERIOD = 18;

    protected $connection = 'mysql_basedatos';

    protected $table = "asignaturas_periodos";

    public $timestamps = false;

    public function academicUnit()
    {
        return $this->setConnection('pgsql')->belongsTo(
            AcademicUnit::class,
            'claveua',
            'key'
        );
    }

    public function area()
    {
        return $this->setConnection('pgsql')->belongsTo(
            Area::class,
            'cve_area',
            'key'
        );
    }

    public function educationalProgram()
    {
        return $this->setConnection('pgsql')->belongsTo(
            EducationalProgram::class,
            'cve_plan',
            'key'
        );
    }
    
    public function subject()
    {
        return $this->setConnection('pgsql')->belongsTo(
            Subject::class,
            'cve_materia',
            'key'
        );
    }

    public function getNameAttribute()
    {
        return $this->materia;
    }

    public function getKeyAttribute()
    {
        return $this->cve_materia;
    }

    public function getTheoreticalHoursAttribute()
    {
        return $this->hs_teoria * self::FACTOR_HOURS_PERIOD;
    }

    public function getPracticalHoursAttribute()
    {
        return $this->hs_lab * self::FACTOR_HOURS_PERIOD;
    }

    public function getProgramDescriptionAttribute()
    {
        return $this->descprograma;
    }

    public function getProgramKeyAttribute()
    {
        return $this->cve_plan;
    }

    public function getAcademicUnitKeyAttribute()
    {
        return $this->claveua;
    }

    public function getAcademicUnitNameAttribute()
    {
        return $this->ua;
    }

    public function getLevelAttribute()
    {
        return $this->nivel;
    }
}
