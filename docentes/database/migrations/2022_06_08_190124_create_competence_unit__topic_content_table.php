<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceUnitTopicContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence_unit__topic_content', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('competence_unit_id');
            $table->unsignedBigInteger('topic_content_id');

            $table
                ->foreign('competence_unit_id')
                ->on('competence_units')
                ->references('id')
                ->onDelete('CASCADE');

            $table
                ->foreign('topic_content_id')
                ->on('topic_contents')
                ->references('id')
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
        Schema::dropIfExists('competence_unit__topic_content');
    }
}
