<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalProgramSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_program__subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('educational_program_id');
            $table->unsignedBigInteger('subject_id');

            $table->foreign('educational_program_id')
                ->references('id')
                ->on('educational_programs')
                ->onDelete('cascade');

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
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
        Schema::dropIfExists('educational_program__subject');
    }
}
