<?php

namespace App\Models;

use App\Src\EducationalProgram\Application\EducationalProgramPDF;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    const MAXIMUM_NUMBER_OF_COLLABORATORS = 7;

    const CREATION_TYPE = "creación";
    const UPDATE_TYPE = "actualización";
    const DIGITALIZATION_TYPE = "digitalización";
    const MODIFICATION_TYPE = "modificación";

    protected $table = "subjects";

    protected $fillable = [
        "title",
        "key",
        "purpose",
        "theoretical_hours",
        "practical_hours",
        "level",
        "credits",
        "is_approved",
        "approved_at",
        "type"
    ];

    protected $appends = ['is_creation'];

    /*
    | ------------------------------
    | Relations
    | ------------------------------
    |
    */

    public function academicUnits()
    {
        return $this->belongsToMany(
            AcademicUnit::class,
            'academic_unit__subject',
            'subject_id',
            'academic_unit_id'
        )->orderBy('name', 'asc');
    }

    public function axes()
    {
        return $this->belongsToMany(
            Axis::class,
            'axis__subject',
            'subject_id',
            'axis_id'
        );
    }

    public function educationalPrograms()
    {
        return $this->belongsToMany(
            EducationalProgram::class,
            'educational_program__subject',
            'subject_id',
            'educational_program_id'
        )->orderBy('name', 'asc');
    }

    public function modules()
    {
        return $this->belongsToMany(
            Module::class,
            'module__subject',
            'subject_id',
            'module_id'
        )->withPivot('is_updateable');
    }

    public function subjectPrograms()
    {
        return $this->hasMany(
            SubjectProgram::class,
            'subject_id',
            'id'
        );
    }

    public function subjectObservations()
    {
        return $this->belongsToMany(
            SubjectObservation::class,
            'subjects__subject_observations',
            'subject_id',
            'subject_observations_id'
        )->orderBy('created_at', 'desc');
    }

    public function units()
    {
        return $this->belongsToMany(
            Unit::class,
            'subject__unit',
            'subject_id',
            'unit_id'
        )->orderBy('created_at', 'asc');
    }

    public function competences()
    {
        return $this->belongsToMany(
            Competence::class,
            'competence__subject',
            'subject_id',
            'competence_id'
        );
    }

    public function competenceUnits()
    {
        return $this->belongsToMany(
            CompetenceUnit::class,
            'competence_unit__subject',
            'subject_id',
            'competence_unit_id'
        );
    }

    public function criteria()
    {
        return $this->belongsToMany(
            Criteria::class,
            'criterion__subject',
            'subject_id',
            'criterion_id'
        )->withPivot('percentage');
    }

    /**
     * If there are not any possible competences then, the educational program competences should displayed
     * 
     */
    public function possibleCompetences()
    {
        return $this->belongsToMany(
            Competence::class,
            'possible_competence__subject',
            'subject_id',
            'competence_id'
        );
    }

    public function resources()
    {
        return $this->belongsToMany(
            Resource::class,
            'resource__subject',
            'subject_id',
            'resource_id'
        );
    }

    public function strategies()
    {
        return $this->belongsToMany(
            Strategy::class,
            'strategy__subject',
            'subject_id',
            'strategy_id'
        );
    }

    public function certificates()
    {
        return $this->belongsToMany(
            Certificate::class,
            'certificate__subject',
            'subject_id',
            'certificate_id'
        );
    }

    public function collaborators()
    {
        return $this->belongsToMany(
            Teacher::class,
            'collaborator__subject',
            'subject_id',
            'teacher_id'
        );
    }

    public function plannings()
    {
        return $this->hasMany(
            Planning::class,
            'subject_id',
            'id'
        );
    }

    public function professionalProfiles()
    {
        return $this->belongsToMany(
            ProfessionalProfile::class,
            'professional_profile__subject',
            'subject_id',
            'professional_profile_id'
        );
    }

    public function responsibles()
    {
        return $this->belongsToMany(
            User::class,
            'responsible__subject',
            'subject_id',
            'user_id'
        );
    }

    public function reviewers()
    {
        return $this->belongsToMany(
            Teacher::class,
            'reviewers',
            'subject_id',
            'teacher_id'
        );
    }

    public function synopsis()
    {
        return $this->belongsToMany(
            Synopsis::class,
            'subject__synopsis',
            'subject_id',
            'synopsis_id'
        );
    }

    public function areas()
    {
        return $this->belongsToMany(
            Area::class,
            'subject__area',
            'subject_id',
            'area_id'
        );
    }

    /*
    | ------------------------------
    | Scopes
    | ------------------------------
    |
    */

    public function scopeWhereResponsible($query, User $user)
    {
        return $query->whereHas('responsibles', function ($query) use ($user) {
            return $query->where('users.id', $user->id);
        });
    }

    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query
            ->where('title', 'ILIKE', '%' . $term . '%')
            ->orWhere('key', 'ILIKE', '%' . $term . '%');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeWhereEducationalProgram($query, EducationalProgram $educationalProgram)
    {
        return $query->whereHas('educationalPrograms', function ($query) use ($educationalProgram) {
            return $query->where('educational_programs.id', $educationalProgram->id);
        });
    }

    public function scopeWhereAcademicUnit($query, AcademicUnit $academicUnit)
    {
        return $query->whereHas('academicUnits', function ($query) use ($academicUnit) {
            return $query->where('academic_units.id', $academicUnit->id);
        });
    }

    /*
    | ------------------------------
    | Calculated attributes
    | ------------------------------
    |
    */

    public function getIsCreationAttribute()
    {
        return $this->type == self::CREATION_TYPE;
    }

    public function getIsDigitalizationAttribute()
    {
        return $this->type == self::DIGITALIZATION_TYPE;
    }

    public function getIsUpdateAttribute()
    {
        return $this->type == self::UPDATE_TYPE;
    }

    public function getIsModificationAttribute()
    {
        return $this->type == self::MODIFICATION_TYPE;
    }

    public function getIsUpdateableAttribute(): bool
    {
        if (auth()->user()->is_administrator) {
            return true;
        }

        if (!auth()->user()->isResponsibleOfSubject($this)) {
            return false;
        }

        if ($this->is_digitalization) {
            return true;
        }

        if ($this->is_approved) {
            return false;
        }

        return true;
    }

    public function getExtraStrategyAttribute()
    {
        return $this
            ->strategies()
            ->whereNotIn('description', strategies())
            ->first();
    }

    public function getExtraResourceAttribute()
    {
        return $this
            ->resources()
            ->whereNotIn('description', resources())
            ->first();
    }

    public function getExtraCriterionAttribute()
    {
        return $this
            ->criteria()
            ->whereNotIn('description', criteria())
            ->first();
    }

    public function getHoursAttribute()
    {
        return $this->theoretical_hours + $this->practical_hours;
    }

    public function getIsFguAttribute()
    {
        return strpos(strtolower($this->key), "fgu") === 0
            ? true
            : false;
    }

    public function getRemainingHoursAttribute()
    {
        return $this->remaining_practical_hours + $this->remaining_theoretical_hours;
    }

    /*
    | ------------------------------
    | extra methods
    | ------------------------------
    |
    */

    public function approve()
    {
        $this->update([
            'is_approved' => true,
            'approved_at' => Carbon::now()
        ]);

        (new EducationalProgramPDF($this))->store();
    }

    public function disapprove()
    {
        $this->update([
            'is_approved' => false,
            'approved_at' => null
        ]);
    }

    public function hasCompetence(Competence $competence)
    {
        return $this
            ->competences()
            ->where('competences.id', $competence->id)
            ->exists();
    }

    public function hasCompetenceUnit(CompetenceUnit $competenceUnit)
    {
        return $this
            ->competenceUnits()
            ->where('competence_units.id', $competenceUnit->id)
            ->exists();
    }

    public function hasStrategy(string $strategyName)
    {
        return $this
            ->strategies()
            ->where('strategies.description', $strategyName)
            ->exists();
    }

    public function hasSynopsis(string $synopsysDescription)
    {
        return $this->synopsis()->where('synopsis.description', $synopsysDescription)->exists();
    }

    public function hasResource(string $resourceDescription)
    {
        return $this->resources()->where('resources.description', $resourceDescription)->exists();
    }

    public function hasAxis(string $axisDescription)
    {
        return $this
            ->axes()
            ->where('axes.description', $axisDescription)
            ->exists();
    }

    public function hasCriterion(string $criterionId)
    {
        return $this->criteria()->where('criteria.description', $criterionId)->exists();
    }

    public function hasCollaborator(Teacher $teacher)
    {
        return $this
            ->collaborators()
            ->where('teachers.id', $teacher->id)
            ->exists();
    }

    public function isTeacherModuleCompleted()
    {
        return $this->responsibles()->exists();
    }

    public function isCertificateModuleCompleted()
    {
        return $this->certificates()->exists();
    }

    public function isContentModuleCompleted()
    {
        return $this->purpose
            && $this->professionalProfiles()->whereAllFieldsNotNull()->exists()
            && $this->competences()->exists()
            && $this->units()->exists();
    }

    public function isGeneralInformationModuleCompleted()
    {
        return $this->strategies()->exists()
            && $this->resources()->exists()
            && ($this->is_fgu || $this->axes()->exists())
            && $this->criteria()->exists();
    }

    public function areAllModulesCompleted()
    {
        return $this->isTeacherModuleCompleted()
            && $this->isContentModuleCompleted()
            && $this->isGeneralInformationModuleCompleted()
            && $this->isCertificateModuleCompleted();
    }

    public function syncCriteriaWithoutDetaching(Criteria $criteria, array $pivot)
    {
        $criterionExists = $this->criteria()->where('criteria.id', $criteria->id)->exists();

        if (!$criterionExists) {
            $this->criteria()->attach($criteria->id, ['percentage' => $pivot['percentage'] ?? 0]);
            return;
        }

        $this->criteria()->updateExistingPivot($criteria->id, ['percentage' => $pivot['percentage'] ?? 0]);
        return;
    }
}
