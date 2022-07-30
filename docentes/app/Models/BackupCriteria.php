<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupCriteria extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_backup';
    protected $table = "criteria";
    public $timestamps = false;
}
