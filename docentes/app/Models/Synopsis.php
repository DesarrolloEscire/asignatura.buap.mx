<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synopsis extends Model
{
    use HasFactory;

    protected $table = "synopsis";

    protected $fillable = [
        "description"
    ];

    public $timestamps = false;
}
