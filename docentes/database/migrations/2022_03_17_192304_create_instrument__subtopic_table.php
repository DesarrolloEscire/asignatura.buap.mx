<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentSubtopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrument__subtopic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instrument_id');
            $table->unsignedBigInteger('subtopic_id');

            $table->foreign('instrument_id')
                ->references('id')
                ->on('instruments')
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
        Schema::dropIfExists('instrument__subtopic');
    }
}
