<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceUnitSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence_unit__subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competence_unit_id');
            $table->unsignedBigInteger('subject_id');

            $table
                ->foreign('competence_unit_id')
                ->references('id')
                ->on('competence_units')
                ->onDelete('CASCADE');
            
                $table
                ->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competence_unit__subject');
    }
}
