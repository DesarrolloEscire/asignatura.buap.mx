<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $table = "abilities";

    protected $fillable = [
        "name"
    ];

    public $timestamps = false;

    public function actions()
    {
        return $this->hasMany(
            Action::class,
            'ability_id'
        );
    }
}
