<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupUser extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_backup';
    protected $table = "users";
    public $timestamps = false;

    public function subjects()
    {
        return $this->belongsToMany(
            BackupSubject::class,
            'responsible__subject',
            'user_id',
            'subject_id'
        );
    }
}
