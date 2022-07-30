<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupSubject extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_backup';
    protected $table = "subjects";
    public $timestamps = false;

    public function certificates()
    {
        return $this->belongsToMany(
            BackupCertificate::class,
            'certificate__subject',
            'subject_id',
            'certificate_id'
        );
    }

    public function competences()
    {
        return $this->belongsToMany(
            BackupCompetences::class,
            'competence__subject',
            'subject_id',
            'competence_id'
        );
    }

    public function plannings()
    {
        return $this->hasMany(
            BackupPlanning::class,
            'subject_id',
            'id'
        );
    }

    public function responsibles()
    {
        return $this->belongsToMany(
            BackupUser::class,
            'responsible__subject',
            'subject_id',
            'user_id'
        );
    }

    public function strategies()
    {
        return $this->belongsToMany(
            BackupStrategy::class,
            'strategy__subject',
            'subject_id',
            'strategy_id'
        );
    }

    public function resources()
    {
        return $this->belongsToMany(
            BackupResources::class,
            'resource__subject',
            'subject_id',
            'resource_id'
        );
    }

    public function axes()
    {
        return $this->belongsToMany(
            BackupAxis::class,
            'axis__subject',
            'subject_id',
            'axis_id'
        );
    }

    public function criteria()
    {
        return $this->belongsToMany(
            BackupCriteria::class,
            'criterion__subject',
            'subject_id',
            'criterion_id'
        )->withPivot('percentage');
    }

    public function units()
    {
        return $this->belongsToMany(
            BackupUnit::class,
            'subject__unit',
            'subject_id',
            'unit_id'
        );
    }

    public function collaborators()
    {
        return $this->belongsToMany(
            BackupTeacher::class,
            'collaborator__subject',
            'subject_id',
            'teacher_id'
        );
    }

    public function professionalProfiles()
    {
        return $this->belongsToMany(
            BackupProfessionalProfile::class,
            'professional_profile__subject',
            'subject_id',
            'professional_profile_id'
        );
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}
