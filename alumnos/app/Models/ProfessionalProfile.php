<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        "academic_level",
        "teaching_experience",
        "professional_experience"
    ];

    protected $table = "professional_profiles";

    public $timestamps = false;

    public function scopeWhereAllFieldsNotNull($query)
    {
        return $query->whereNotNull('academic_level')
            ->whereNotNull('teaching_experience')
            ->whereNotNull('professional_experience');
    }
}
