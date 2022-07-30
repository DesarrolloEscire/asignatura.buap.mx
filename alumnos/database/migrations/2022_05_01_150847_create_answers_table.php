<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('choice_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->boolean('is_updateable')->default(0);
            
            $table->foreign('choice_id', 'answers_choice_id_foreign')->references('id')->on('choices')->onDelete('set NULL');
            $table->foreign('evaluation_id', 'answers_evaluation_id_foreign')->references('id')->on('evaluations')->onDelete('cascade');
            $table->foreign('question_id', 'answers_question_id_foreign')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
