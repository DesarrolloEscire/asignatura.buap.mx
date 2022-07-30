<?php

namespace App\Models;

use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Searchable, HasRoles;

    protected $fillable = [
        'identifier',
        'name',
        'email',
        'password',
        'profile_photo_path',
        'last_login_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    |
    */
    public function academicUnits()
    {
        return $this->belongsToMany(
            AcademicUnit::class,
            'academic_unit__user',
            'user_id',
            'academic_unit_id'
        );
    }

    public function plannings()
    {
        return $this->belongsToMany(
            Planning::class,
            'planning__user',
            'user_id',
            'planning_id'
        );
    }

    public function repositories()
    {
        return $this->hasMany(
            Repository::class,
            'responsible_id'
        );
    }

    /**
     * Subjects whose responsible is the user
     * 
     */
    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'responsible__subject',
            'user_id',
            'subject_id'
        );
    }

    public function asTeacher()
    {
        return $this->hasOne(
            Teacher::class,
            'identifier',
            'identifier'
        );
    }

    public function asStudent()
    {
        return $this->hasOne(
            Student::class,
            'identifier',
            'identifier'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Calculated attributes
    |--------------------------------------------------------------------------
    |
    */

    public function getIsAdministratorAttribute()
    {
        return $this->hasRole(Role::ADMINISTRATOR_ROLE);
    }

    public function getIsDirectorAttribute()
    {
        return $this->hasRole(Role::DIRECTOR_ROLE);
    }

    public function getIsSecretaryAttribute()
    {
        return $this->hasRole(Role::SECRETARY_ROLE);
    }

    public function getIsCoordinatorAttribute()
    {
        return $this->hasRole(Role::COORDINATOR_ROLE);
    }

    /*
    |--------------------------------------------------------------------------
    | Scope methods
    |--------------------------------------------------------------------------
    |
    */

    public function scopeWhereRoleName($query, string $roleName)
    {
        return $query->whereHas('roles', function ($query) use ($roleName) {
            return $query->where('roles.name', $roleName);
        });
    }

    public function scopeWhereIdentifier($query, string $identifier)
    {
        return $query->where('identifier', $identifier);
    }

    public function scopeWhereNotIdentifier($query, string $identifier)
    {
        return $query->where('identifier', '!=', $identifier)->orWhereNull('identifier');
    }

    public function scopeAdministrators($query)
    {
        return $query->whereHas('roles', function ($query) {
            return $query->where('name', Role::ADMINISTRATOR_ROLE);
        });
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    public function scopeNotVerified($query)
    {
        return $query->whereNull('email_verified_at');
    }

    public function scopeWhereUser($query, User $user)
    {
        return $query->where('users.id', $user->id);
    }

    /*
    |--------------------------------------------------------------------------
    | Extra methods
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Verify user to allow him to acces in the platform
     * 
     */
    public function verify()
    {
        $this->email_verified_at = Carbon::now();
        $this->save();
    }

    public function isResponsibleOfSubject(Subject $subject)
    {
        return $this
            ->subjects()
            ->where('subjects.id', $subject->id)
            ->exists();
    }


    public function isResponsibleOfPlanning(Planning $planning)
    {
        return $this
            ->plannings()
            ->where('plannings.id', $planning->id)
            ->exists();
    }
}
