<?php

use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateModuleSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module__subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('subject_id');
            $table->boolean('is_updateable')->default(true);

            $table
                ->foreign('module_id')
                ->references('id')
                ->on('modules')
                ->onDelete('CASCADE');

            $table
                ->foreign('subject_id')
                ->references('id')
                ->on('subjects')
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
        Schema::dropIfExists('module__subject');
    }
}
