<?php

use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->enum('type', ['creación', 'actualización', 'existente'])->default('creación');
        });

        Subject::get()->map(function ($subject) {
            $subject->update([
                'type' => $subject->is_creation ? 'creación' : 'actualización'
            ]);
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('is_creation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->boolean('is_creation')->nullable();
        });

        Subject::get()->map(function ($subject) {
            $subject->update([
                'is_creation' => $subject->is_creation ? true : false
            ]);
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->boolean('is_creation')->change();
        });
    }
}
