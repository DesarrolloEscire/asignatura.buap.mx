<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubtopicContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtopic_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planning_id');
            $table->unsignedBigInteger('subtopic_id');

            $table->unsignedInteger('theoretical_hours')->default(0);
            $table->unsignedInteger('practical_hours')->default(0);
            $table->unsignedInteger('independent_hours')->default(0);

            $table->text('activity')->nullable();
            $table->unsignedDecimal('weighing')->default(0);

            $table->foreign('planning_id')
                ->references('id')
                ->on('plannings')
                ->onDelete('CASCADE');

            $table->foreign('subtopic_id')
                ->references('id')
                ->on('subtopics')
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
        Schema::dropIfExists('planning__subtopic');
    }
}
