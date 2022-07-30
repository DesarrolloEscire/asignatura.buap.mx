<?php

use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicUnitEducationalProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_unit__educational_program', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('academic_unit_id');
            $table->unsignedBigInteger('educational_program_id');

            $table->foreign('academic_unit_id', 'academic_unit_foreign')
                ->references('id')
                ->on('academic_units')
                ->onDelete('cascade');

            $table->foreign('educational_program_id', 'educational_program_foreign')
                ->references('id')
                ->on('educational_programs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_unit__educational_program');
    }
}
