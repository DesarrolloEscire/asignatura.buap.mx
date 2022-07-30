<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentTopicContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrument__topic_content', function (Blueprint $table) {
            $table->unsignedBigInteger('instrument_id');
            $table->unsignedBigInteger('topic_content_id');

            $table->foreign('instrument_id')
                ->references('id')
                ->on('instruments')
                ->onDelete('CASCADE');

            $table->foreign('topic_content_id')
                ->references('id')
                ->on('topic_contents')
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
        Schema::dropIfExists('instrument__topic_content');
    }
}
