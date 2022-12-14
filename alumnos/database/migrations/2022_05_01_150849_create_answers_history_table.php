<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_history_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('choice_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->foreign('choice_id', 'answers_history_choice_id_foreign')->references('id')->on('choices')->onDelete('cascade');
            $table->foreign('evaluation_history_id', 'answers_history_evaluation_history_id_foreign')->references('id')->on('evaluations_history')->onDelete('cascade');
            $table->foreign('question_id', 'answers_history_question_id_foreign')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers_history');
    }
}
