<?php

namespace Database\Seeders;

use App\Models\OfertaeTeacher;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ofertaeTeachers = OfertaeTeacher::get();

        $ofertaeTeachers->map(function ($ofertaeTeacher) {

            if (!$ofertaeTeacher->identifier) {
                return;
            }

            $teacher = Teacher::firstOrCreate([
                'name' => $ofertaeTeacher->full_name,
                'email' => $ofertaeTeacher->email,
                'identifier' => $ofertaeTeacher->identifier,
            ]);

            if(!$ofertaeTeacher->academicUnit){
                return;
            }
            
            $teacher
                ->academicUnits()
                ->sync([$ofertaeTeacher->academicUnit->id]);
        });
    }
}
