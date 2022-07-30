<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $table = "criteria";

    protected $fillable = [
        "description"
    ];

    public $timestamps = false;


    public function scopeWhereDescription($query, string $description)
    {
        return $query->where('description', $description);
    }
}
