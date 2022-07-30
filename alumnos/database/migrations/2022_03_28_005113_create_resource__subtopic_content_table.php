<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceSubtopicContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource__subtopic_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resource_id');
            $table->unsignedBigInteger('subtopic_content_id');

            $table->foreign('resource_id')
                ->references('id')
                ->on('resources')
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
        Schema::dropIfExists('resource__subtopic_content');
    }
}
