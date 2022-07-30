<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBibliographyUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bibliography__unit', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('bibliography_id');
            $table->unsignedBigInteger('unit_id');

            $table->foreign('bibliography_id')
                ->references('id')
                ->on('bibliographies')
                ->onDelete('cascade');

            $table->foreign('unit_id')
                ->references('id')
                ->on('units')
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
        Schema::dropIfExists('bibliography__unit');
    }
}
