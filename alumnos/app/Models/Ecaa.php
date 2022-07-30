<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * 
 */
class Ecaa extends Model
{
    use HasFactory;

    protected $table = "ecaas";

    protected $fillable = [
        "planning_id",
        "date",
    ];
}
