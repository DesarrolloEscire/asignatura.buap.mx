<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strategy extends Model
{
    use HasFactory;

    protected $table = "strategies";

    protected $fillable = [
        "description"
    ];

    public $timestamps = false;


    /*
    | ------------------------------
    | Scope methods
    | ------------------------------
    |
    */

    public function scopeFromSystem($query)
    {
        return $query->whereIn('description', strategies());
    }

    public function scopeAdditional($query)
    {
        return $query->whereNotIn('description', strategies());
    }
}
