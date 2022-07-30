<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentUnitContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrument__unit_content', function (Blueprint $table) {
            $table->unsignedBigInteger('instrument_id');
            $table->unsignedBigInteger('unit_content_id');

            $table->foreign('instrument_id')
                ->references('id')
                ->on('instruments')
                ->onDelete('CASCADE');

            $table->foreign('unit_content_id')
                ->references('id')
                ->on('unit_contents')
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
        Schema::dropIfExists('instrument__unit_content');
    }
}
