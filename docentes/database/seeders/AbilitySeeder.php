<?php

namespace Database\Seeders;

use App\Models\Ability;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ability::firstOrCreate([
            'name' => 'recordar'
        ]);
        Ability::firstOrCreate([
            'name' => 'comprender'
        ]);
        Ability::firstOrCreate([
            'name' => 'aplicar'
        ]);
        Ability::firstOrCreate([
            'name' => 'analizar'
        ]);
        Ability::firstOrCreate([
            'name' => 'evaluar'
        ]);
        Ability::firstOrCreate([
            'name' => 'crear'
        ]);
    }
}
