<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentSubtopicContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrument__subtopic_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instrument_id');
            $table->unsignedBigInteger('subtopic_content_id');

            $table->foreign('instrument_id')
                ->references('id')
                ->on('instruments')
                ->onDelete('CASCADE');

            $table->foreign('subtopic_content_id')
                ->references('id')
                ->on('subtopic_contents')
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
        Schema::dropIfExists('instrument__subtopic_content');
    }
}
