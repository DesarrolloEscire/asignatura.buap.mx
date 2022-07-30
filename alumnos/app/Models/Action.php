<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $table = "actions";

    protected $fillable = [
        "ability_id",
        "name"
    ];

    public $timestamps = false;

    public function ability()
    {
        return $this->belongsTo(Ability::class);
    }
}
