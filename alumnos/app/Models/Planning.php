<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'is_published'
    ];

    public function ecaas()
    {
        return $this->hasMany(
            Ecaa::class,
            'planning_id',
            'id'
        );
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'planning__user',
            'planning_id',
            'user_id'
        )->withPivot('type');
    }

    public function subject()
    {
        return $this->belongsTo(
            Subject::class,
            'subject_id'
        );
    }

    public function topicContents()
    {
        return $this->hasMany(
            TopicContent::class,
            'planning_id'
        );
    }

    public function subtopicContents()
    {
        return $this->hasMany(
            SubtopicContent::class,
            'planning_id'
        );
    }

    public function topics()
    {
        return $this->belongsToMany(
            Topic::class,
            'planning__topic',
            'planning_id',
            'topic_id'
        )->withPivot('theoretical_hours', 'practical_hours', 'independent_hours');
    }

    /*
    | ------------------------------
    | scope methods
    | ------------------------------
    |
    */

    public function scopeWhereUser($query, User $user)
    {
        return $query->whereHas('users', function ($query) use ($user) {
            return $query->where('users.id', $user->id);
        });
    }

    /*
    | ------------------------------
    | calculated attributes
    | ------------------------------
    |
    */

    public function getTheoreticalHoursAttribute()
    {
        return $this->topicContents()->sum('theoretical_hours');
    }

    public function getPracticalHoursAttribute()
    {
        return $this->topicContents()->sum('practical_hours');
    }

    public function getRemainingTheoreticalHoursAttribute()
    {
        return $this->subject->theoretical_hours - $this->theoretical_hours;
    }

    public function getRemainingPracticalHoursAttribute()
    {
        return $this->subject->practical_hours - $this->practical_hours;
    }

    /*
    | ------------------------------
    | extra methods
    | ------------------------------
    |
    */
    public function publish()
    {
        $this->update([
            'is_published' => true
        ]);
    }

    public function unpublish()
    {
        $this->update([
            'is_published' => false
        ]);
    }
}
