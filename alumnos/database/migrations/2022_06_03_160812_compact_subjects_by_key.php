<?php

use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompactSubjectsByKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Subject::chunk(200, function ($subjects) {
            $subjects->each(function ($currentSubject) {

                if (!$currentSubject->educationalPrograms()->exists()) {
                    // echo "$currentSubject->key does not have educational programs";
                    return;
                }

                $siblingSubjects = $this->_siblingSubjects($currentSubject);

                $siblingSubjects->each(function ($subject) use ($currentSubject) {
                    $subject->academicUnits()->syncWithoutDetaching($currentSubject->academicUnits->pluck('id'));
                    $subject->educationalPrograms()->syncWithoutDetaching($currentSubject->educationalPrograms->pluck('id'));
                });

                $totalSubjects = Subject::where('key', $currentSubject->key)
                    ->whereEducationalProgram($currentSubject->educationalPrograms()->first())
                    ->count();

                $hasResponsibles = $currentSubject->responsibles()->count();

                if ($hasResponsibles) {
                    // echo "$currentSubject->key won't be deleted because has Responsibles ($hasResponsibles)\n";
                    return;
                }

                if ($totalSubjects <= 1) {
                    // echo "$currentSubject->key won't be deleted because there is just one subject ($totalSubjects)\n";
                    return;
                }

                echo "$currentSubject->key will be deleted. (responsibles $hasResponsibles) | (total subjects $totalSubjects)\n";
                $currentSubject->delete();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
