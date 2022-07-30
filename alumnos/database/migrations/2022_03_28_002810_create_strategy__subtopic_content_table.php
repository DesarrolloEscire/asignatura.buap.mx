<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrategySubtopicContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strategy__subtopic_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('strategy_id');
            $table->unsignedBigInteger('subtopic_content_id');

            $table->foreign('strategy_id')
                ->references('id')
                ->on('strategies')
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
        Schema::dropIfExists('strategy__subtopic_content');
    }
}
