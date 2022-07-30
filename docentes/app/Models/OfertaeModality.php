<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaeModality extends Model
{
    use HasFactory;

    protected $connection = 'mysql_basedatos';

    protected $table = "areas_modalidades";

    public $timestamps = false;

    public function educationalProgram()
    {
        return $this->setConnection('pgsql')->belongsTo(
            EducationalProgram::class,
            'cve_plan',
            'key'
        );
    }

    public function scopeWhereProgramKey($query, $key)
    {
        return $query->where('cve_plan', $key);
    }

    public function getModalityAttribute()
    {
        return $this->modalidad;
    }
}
