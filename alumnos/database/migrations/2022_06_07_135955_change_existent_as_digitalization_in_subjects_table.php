<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeExistentAsDigitalizationInSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE subjects DROP CONSTRAINT subjects_type_check");

        $types = ['digitalización', 'creación', 'actualización', 'existente'];
        $result = join( ', ', array_map(function ($value){
            return sprintf("'%s'::character varying", $value);
        }, $types));

        DB::statement("ALTER TABLE subjects ADD CONSTRAINT subjects_type_check CHECK (type::text = ANY (ARRAY[$result]::text[]))");

        DB::table('subjects')
            ->where('type', 'existente')
            ->update(['type' => 'digitalización']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            //
        });
    }
}
