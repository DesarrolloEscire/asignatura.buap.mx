<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planning_id');
            $table->unsignedBigInteger('topic_id');

            $table->unsignedInteger('theoretical_hours')->default(0);
            $table->unsignedInteger('practical_hours')->default(0);
            $table->unsignedInteger('independent_hours')->default(0);

            $table->text('activity')->nullable();
            $table->unsignedDecimal('weighing')->default(0);

            $table->foreign('planning_id')
                ->references('id')
                ->on('plannings')
                ->onDelete('CASCADE');

            $table->foreign('topic_id')
                ->references('id')
                ->on('topics')
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
        Schema::dropIfExists('topic_contents');
    }
}
