<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupTeacher extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_backup';
    protected $table = "teachers";
    public $timestamps = false;
}
