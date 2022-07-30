<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaeSpecificCompetence extends Model
{
    use HasFactory;

    protected $connection = 'mysql_ofertae';

    protected $table = "competencias_especificas";

    public $timestamps = false;

    public function educationalProgram()
    {
        return $this->setConnection('pgsql')->belongsTo(
            EducationalProgram::class,
            'cve_plan',
            'key'
        );
    }

    public function getDescriptionAttribute()
    {
        return $this->Competencias_Específicas;
    }

    public function getAcademicUnitCodeAttribute()
    {
        return $this->UA;
    }

    public function getEducationalProgramCodeAttribute()
    {
        return $this->PE;
    }
}
