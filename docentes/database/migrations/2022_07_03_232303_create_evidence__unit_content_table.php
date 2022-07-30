<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenceUnitContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence__unit_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evidence_id');
            $table->unsignedBigInteger('unit_content_id');

            $table->foreign('evidence_id')
                ->references('id')
                ->on('evidences')
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
        Schema::dropIfExists('evidence__unit_content');
    }
}
