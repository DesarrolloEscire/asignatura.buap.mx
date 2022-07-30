<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectObservation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "is_approved",
        "description",
        "created_at",
        "updated_at"
    ];
}
