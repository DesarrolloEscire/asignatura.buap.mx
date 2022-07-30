<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcaasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecaas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planning_id');
            $table->date('date');
            $table->timestamps();

            $table
                ->foreign('planning_id')
                ->references('id')
                ->on('plannings')
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
        Schema::dropIfExists('ecaas');
    }
}
