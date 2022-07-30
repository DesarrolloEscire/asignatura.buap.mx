<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repositories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responsible_id');
            $table->string('name');
            $table->enum('status', ['en progreso', 'aprobado', 'rechazado', 'observaciones'])->default('en progreso');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            
            $table->foreign('responsible_id', 'repositories_responsible_id_foreign')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repositories');
    }
}
