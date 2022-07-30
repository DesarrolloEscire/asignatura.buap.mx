<?php

namespace Database\Seeders;

use App\Models\Role as ModelsRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name' => ModelsRole::ADMINISTRATOR_ROLE
        ]);
        Role::firstOrCreate([
            'name' => ModelsRole::EVALUATOR_ROLE
        ]);
        Role::firstOrCreate([
            'name' => ModelsRole::TEACHER_ROLE
        ]);
        Role::firstOrCreate([
            'name' => ModelsRole::COORDINATOR_ROLE
        ]);
        Role::firstOrCreate([
            'name' => ModelsRole::DIRECTOR_ROLE
        ]);
        Role::firstOrCreate([
            'name' => ModelsRole::SECRETARY_ROLE
        ]);
    }
}
