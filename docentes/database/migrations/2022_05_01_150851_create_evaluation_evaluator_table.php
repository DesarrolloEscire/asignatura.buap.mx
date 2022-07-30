<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationEvaluatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_evaluator', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('evaluation_id');
            $table->timestamps();
            
            $table->foreign('evaluation_id', 'evaluation_evaluator_evaluation_id_foreign')->references('id')->on('evaluations')->onDelete('cascade');
            $table->foreign('user_id', 'evaluation_evaluator_user_id_foreign')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation_evaluator');
    }
}
