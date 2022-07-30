<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupProfessionalProfile extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_backup';
    protected $table = "professional_profiles";
    public $timestamps = false;
}
