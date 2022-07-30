<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicUnitStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_unit__student', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('academic_unit_id');
            $table->unsignedBigInteger('student_id');

            $table->foreign('academic_unit_id')
                ->references('id')
                ->on('academic_units')
                ->onDelete('cascade');

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
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
        Schema::dropIfExists('academic_unit__student');
    }
}
