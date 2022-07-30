<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        "path",
        "approved_at",
        "designed_at",
        "last_update_at"
    ];

    public $table = "certificates";
}
