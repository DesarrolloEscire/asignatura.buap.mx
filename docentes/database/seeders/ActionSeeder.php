<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Action::firstOrCreate([
            'ability_id' => 1,
            'name' => 'describir',
        ]);
        Action::firstOrCreate([
            'ability_id' => 1,
            'name' => 'encontrar',
        ]);
        Action::firstOrCreate([
            'ability_id' => 1,
            'name' => 'clasificar',
        ]);
        Action::firstOrCreate([
            'ability_id' => 1,
            'name' => 'comparar',
        ]);
    }
}
