<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalProfileSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_profile__subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professional_profile_id');
            $table->unsignedBigInteger('subject_id');

            $table->foreign('professional_profile_id')
                ->references('id')
                ->on('professional_profiles')
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
        Schema::dropIfExists('professional_profile__subject');
    }
}
