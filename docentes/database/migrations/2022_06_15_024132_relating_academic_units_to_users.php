<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

class RelatingAcademicUnitsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::has('subjects')->get()->each(function ($user) {
            $academicUnitIds = $user->subjects->pluck('academicUnits')->flatten()->pluck('id')->toArray();
            $user
                ->academicUnits()
                ->syncWithoutDetaching($academicUnitIds);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
