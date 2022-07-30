<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackingHoursColumnToSubtopicContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subtopic_contents', function (Blueprint $table) {
            $table->unsignedInteger('tracking_hours')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subtopic_contents', function (Blueprint $table) {
            $table->dropColumn('tracking_hours');
        });
    }
}
