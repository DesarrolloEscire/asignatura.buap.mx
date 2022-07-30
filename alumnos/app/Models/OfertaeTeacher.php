<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaeTeacher extends Model
{
    use HasFactory;

    // protected $connection = 'mysql_ofertae';
    protected $connection = 'mysql_basedatos';
    protected $table = "bddocentes";
    public $timestamps = false;

    public function academicUnit()
    {
        return $this->setConnection('pgsql')->belongsTo(
            AcademicUnit::class,
            'CAVEDEP',
            'key'
        );
    }

    public function getIdentifierAttribute()
    {
        return $this->ID;
    }

    public function getFullNameAttribute()
    {
        return $this->NOMBRE;
    }

    public function getEmailAttribute()
    {
        return $this->CORREO;
    }
}
