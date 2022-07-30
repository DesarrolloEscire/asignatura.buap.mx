<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaeGenericCompetence extends Model
{
    use HasFactory;

    protected $connection = 'mysql_ofertae';

    protected $table = "competencia_genericas_fgu";

    public $timestamps = false;

    public function getDescriptionAttribute()
    {
        return $this->Competencia_Genérica;
    }

    public function getUnitsAttribute()
    {
        return $this->Unidades_de_Competencia;
    }
}
