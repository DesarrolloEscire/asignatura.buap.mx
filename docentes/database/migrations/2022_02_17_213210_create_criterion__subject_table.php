<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriterionSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterion__subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criterion_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedDecimal('percentage')->nullable();

            $table->foreign('criterion_id')
                ->references('id')
                ->on('criteria')
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
        Schema::dropIfExists('criterion__subject');
    }
}
