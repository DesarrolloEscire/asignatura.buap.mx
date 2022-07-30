<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemoteAcademicUnit extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = "academic_units";
}
