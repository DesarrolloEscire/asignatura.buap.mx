<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceCompetenceUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competence__competence_unit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competence_id');
            $table->unsignedBigInteger('competence_unit_id');

            $table
                ->foreign('competence_id')
                ->references('id')
                ->on('competences')
                ->onDelete('CASCADE');

            $table
                ->foreign('competence_unit_id')
                ->references('id')
                ->on('competence_units')
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
        Schema::dropIfExists('competence__competence_unit');
    }
}
