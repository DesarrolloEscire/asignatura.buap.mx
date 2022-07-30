<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionSubtopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action__subtopic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subtopic_id');
            $table->unsignedBigInteger('action_id');

            $table
                ->foreign('subtopic_id')
                ->references('id')
                ->on('subtopics')
                ->onDelete('cascade');

            $table
                ->foreign('action_id')
                ->references('id')
                ->on('actions')
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
        Schema::dropIfExists('subtopic_action');
    }
}
