<?php

use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAreasForFguSubjects extends Migration
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
            $subject->areas()->detach();
        });

        $subjects = Subject::where('key', 'ilike', 'FGUM%');

        $subjects->each(function ($subject) {
            $subject->areas()->detach();
        });
        $subjects = Subject::where('key', 'ilike', 'FGUO%');
        
        $subjects->each(function ($subject) {
            $subject->areas()->detach();
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
