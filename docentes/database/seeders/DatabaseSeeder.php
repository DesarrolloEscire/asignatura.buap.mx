<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            SubjectSeeder::class,
            OptativeSubjectSeeder::class,
            CompetenceSeeder::class,
            TeacherSeeder::class,
            UserSeeder::class,
            ResponsibleSubjectSeeder::class,
            AreaSeeder::class,
            SubjectAreaSeeder::class,
        ]);
    }
}
