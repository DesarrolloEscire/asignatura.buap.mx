<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceUnitContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence__unit_content', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('competence_id');
            $table->unsignedBigInteger('unit_content_id');

            $table
                ->foreign('competence_id')
                ->on('competences')
                ->references('id')
                ->onDelete('CASCADE');

            $table
                ->foreign('unit_content_id')
                ->on('unit_contents')
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
        Schema::dropIfExists('competence__unit_content');
    }
}
