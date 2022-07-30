<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = "units";

    protected $fillable = [
        "name",
    ];

    /*
    | -------------------------------------------
    | Relations
    | -------------------------------------------
    |
    */

    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'subject__unit',
            'unit_id',
            'subject_id'
        );
    }

    public function topics()
    {
        return $this->hasMany(
            Topic::class
        );
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'unit__user',
            'unit_id',
            'user_id'
        );
    }

    public function bibliographies()
    {
        return $this->belongsToMany(
            Bibliography::class,
            'bibliography__unit',
            'unit_id',
            'bibliography_id'
        );
    }

    /*
    | -------------------------------------------
    | Calcultated attributes
    | -------------------------------------------
    |
    */

    public function getNextEmptyPositionAttribute()
    {
        $lastTopic = $this->topics()->orderBy('position', 'DESC')->first();

        return $lastTopic
            ? $lastTopic->position + 1
            : 0;
    }

    public function getMinutesAttribute()
    {
        return $this->topics->pluck('minutes')->sum();
    }

    public function getPracticalHoursAttribute()
    {
        return $this->topics()->sum('practical_hours');
    }

    public function getTheoreticalHoursAttribute()
    {
        return $this->topics()->sum('theoretical_hours');
    }

    public function getHoursAttribute()
    {
        return $this->theoretical_hours + $this->practical_hours;
    }
}
