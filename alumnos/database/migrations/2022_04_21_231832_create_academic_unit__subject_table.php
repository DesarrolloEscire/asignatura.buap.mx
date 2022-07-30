<?php

use App\Models\EducationalProgram;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicUnitSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_unit__subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_unit_id');
            $table->unsignedBigInteger('subject_id');

            $table->foreign('academic_unit_id')
                ->references('id')
                ->on('academic_units')
                ->onDelete('cascade');

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade');
        });

        Subject::get()->map(function ($subject) {
            echo "$subject->id\n";
            $academicUnitIds = $subject->educationalPrograms->pluck('academicUnits')->flatten()->pluck('id');
            $subject->academicUnits()->sync($academicUnitIds);
        });

        EducationalProgram::get()->map(function ($educationalProgram) {

            if (!EducationalProgram::find($educationalProgram->id)) {
                return;
            }

            $educationalProgramsRepeated = EducationalProgram::where('key', $educationalProgram->key)
                ->where('id', '!=', $educationalProgram->id)
                ->get();

            $subjectIds = $educationalProgramsRepeated->pluck('subjects')->flatten()->pluck('id');
            $academicUnitIds = $educationalProgramsRepeated->pluck('academicUnits')->flatten()->pluck('id');

            $educationalProgram->academicUnits()->syncWithoutDetaching($academicUnitIds);
            $educationalProgram->subjects()->syncWithoutDetaching($subjectIds);

            EducationalProgram::whereIn('id', $educationalProgramsRepeated->pluck('id'))->delete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_unit__subject');
    }
}
