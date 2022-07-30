<?php

use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;

class RemoveEducationalProgramsForFugsSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $subjects = Subject::where('key', 'ilike', 'FGUS%');

        $subjects->each(function ($subject) {
            $subject->educationalPrograms()->detach();
        });

        $subjects = Subject::where('key', 'ilike', 'FGUM%');

        $subjects->each(function ($subject) {
            $subject->educationalPrograms()->detach();
        });
        $subjects = Subject::where('key', 'ilike', 'FGUO%');
        
        $subjects->each(function ($subject) {
            $subject->educationalPrograms()->detach();
        });
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
