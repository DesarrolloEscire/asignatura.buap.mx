<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAxisSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('axis__subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('axis_id');
            $table->unsignedBigInteger('subject_id');

            $table->foreign('axis_id')
                ->references('id')
                ->on('axes')
                ->onDelete('CASCADE');

            $table->foreign('subject_id')
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
        Schema::dropIfExists('axis__subject');
    }
}
