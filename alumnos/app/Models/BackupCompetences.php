<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupCompetences extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_backup';
    protected $table = "competences";
    public $timestamps = false;
}
