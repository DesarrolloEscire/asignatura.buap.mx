<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsSubjectObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects__subject_observations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('subject_observations_id');

            $table->foreign('subject_id', 'subjects__subject_observations_subject_id_foreign')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('subject_observations_id', 'subjects__subject_observations_subject_observations_id_foreign')->references('id')->on('subject_observations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects__subject_observations');
    }
}
