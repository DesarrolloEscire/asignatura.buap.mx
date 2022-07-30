<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicUnitTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_unit__teacher', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('academic_unit_id');
            $table->unsignedBigInteger('teacher_id');

            $table->foreign('academic_unit_id')
                ->references('id')
                ->on('academic_units')
                ->onDelete('cascade');

            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
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
        Schema::dropIfExists('academic_unit__teacher');
    }
}
