<?php

use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAcademicUnitsForFguSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Subject::where('key', 'ilike', 'FGUS%')->get()->each(function ($subject) {
            $this->_handle($subject);
        });
        
        Subject::where('key', 'ilike', 'FGUM%')->get()->each(function ($subject) {
            $this->_handle($subject);
        });
        
        Subject::where('key', 'ilike', 'FGUO%')->get()->each(function ($subject) {
            $this->_handle($subject);
        });
    }

    private function _handle($subject)
    {
        $subject
            ->academicUnits()
            ->detach();

        if (
            Subject::where('key', $subject->key)->count() == 1 ||
            $subject->responsibles()->count() >= 1
        ) {
            return;
        }

        $subject->delete();
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
