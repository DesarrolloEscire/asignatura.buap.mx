<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_contents', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('planning_id');
            $table->unsignedBigInteger('unit_id');

            $table->unsignedDecimal('weighing')->default(0);

            $table
                ->foreign('planning_id')
                ->references('id')
                ->on('plannings')
                ->onDelete('CASCADE');
            
                $table
                ->foreign('unit_id')
                ->references('id')
                ->on('units')
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
        Schema::dropIfExists('unit_contents');
    }
}
