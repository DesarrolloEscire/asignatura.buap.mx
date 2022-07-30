<?php

namespace App\Imports;

use App\Models\AcademicUnit;
use App\Models\EducationalProgram;
use App\Models\Subject;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SharedSubjectsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $collection->groupBy('cve_asignatura')->each(function ($subjectGroup) {

            $educationalProgramKeys = $subjectGroup->pluck('cve_plan');

            $subjectGroup->each(function ($subjectRow) use ($educationalProgramKeys) {

                Subject::where('key', $subjectRow['cve_asignatura'])->get()->each(function ($subject) use ($educationalProgramKeys) {

                    $siblingSubjects = $this->_siblingSubjects($subject);

                    $siblingSubjects->each(function ($siblingSubject) use ($subject) {
                        $siblingSubject->academicUnits()->syncWithoutDetaching($subject->academicUnits->pluck('id'));
                    });

                    $educationalPrograms = EducationalProgram::whereIn('key', $educationalProgramKeys)->get();
                    $educationalProgramIds = $educationalPrograms->pluck('id');
                    echo "inserting $educationalProgramIds to $subject->key | ";
                    $subject->educationalPrograms()->syncWithoutDetaching($educationalProgramIds->flatten()->toArray());

                    $totalEducationalPrograms = $subject->educationalPrograms()->count();
                    echo "total: $totalEducationalPrograms\n";
                });

                Subject::where('key', $subjectRow['cve_asignatura'])->get()->each(function ($subject) use ($educationalProgramKeys) {

                    if (Subject::where('key', $subject->key)->count() == 1 || $subject->responsibles()->count() >= 1) {
                        echo "$subject->key won't be removed \n";
                        return;
                    }

                    $subject->delete();
                });
            });
        });
    }

    private function _siblingSubjects($currentSubject)
    {
        return Subject::where('key', $currentSubject->key)
            ->where('id', '!=', $currentSubject->id)
            ->whereEducationalProgram($currentSubject->educationalPrograms()->first())
            ->get();
    }
}

class SubjectCollection
{
    private $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }
}
