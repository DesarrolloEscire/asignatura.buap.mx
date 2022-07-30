<?php

use App\Models\OfertaeTeacher;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AttachingAcademicUnitsToTeachers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::get()->each(function ($user) {

            if (!$user->asTeacher) {
                return;
            }

            $academicUnitIds = $user
                ->asTeacher
                ->academicUnits
                ->pluck('id')
                ->flatten()
                ->toArray();

            $user->academicUnits()->syncWithoutDetaching($academicUnitIds);
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
