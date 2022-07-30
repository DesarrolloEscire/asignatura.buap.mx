<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaeOptativeSubject extends Model
{
    use HasFactory;

    const FACTOR_HOURS_PERIOD = 18;

    protected $connection = 'mysql_basedatos';

    protected $table = "optativas";

    public $timestamps = false;

    public function academicUnit()
    {
        return $this->setConnection('pgsql')->belongsTo(
            AcademicUnit::class,
            'CLAVEUA',
            'key'
        );
    }
    
    public function educationalProgram()
    {
        return $this->setConnection('pgsql')->belongsTo(
            EducationalProgram::class,
            'CVE_PLAN',
            'key'
        );
    }

    public function area()
    {
        return $this->setConnection('pgsql')->belongsTo(
            Area::class,
            'CVE_AREA',
            'key'
        );
    }

    public function getNameAttribute()
    {
        return $this->MATERIA;
    }

    public function getKeyAttribute()
    {
        return $this->CVE_MATERIA;
    }

    public function getCreditsAttribute()
    {
        return $this->HS_CREDITO;
    }

    public function getTheoreticalHoursAttribute()
    {
        return $this->HS_TEORIA * self::FACTOR_HOURS_PERIOD;
    }

    public function getPracticalHoursAttribute()
    {
        return $this->HS_LAB * self::FACTOR_HOURS_PERIOD;
    }

    public function getProgramDescriptionAttribute()
    {
        return $this->DESCPROGRAMA;
    }

    public function getProgramKeyAttribute()
    {
        return $this->CVE_PLAN;
    }

    public function getAcademicUnitKeyAttribute()
    {
        return $this->CLAVEUA;
    }

    public function getAcademicUnitNameAttribute()
    {
        return $this->UA;
    }

    public function getLevelAttribute()
    {
        return $this->NIVEL;
    }
}
