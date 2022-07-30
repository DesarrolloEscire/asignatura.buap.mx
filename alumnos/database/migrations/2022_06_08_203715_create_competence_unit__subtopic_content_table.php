<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceUnitSubtopicContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence_unit__subtopic_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competence_unit_id');
            $table->unsignedBigInteger('subtopic_content_id');

            $table
                ->foreign('competence_unit_id')
                ->references('id')
                ->on('competence_units');

            $table
                ->foreign('subtopic_content_id')
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
        Schema::dropIfExists('competence_unit__subtopic_content');
    }
}
