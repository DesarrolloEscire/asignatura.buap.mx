<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::firstOrCreate(['name'=>'autores']);
        Module::firstOrCreate(['name'=>'propósito']);
        Module::firstOrCreate(['name'=>'perfil de docente']);
        Module::firstOrCreate(['name'=>'competencias profesionales']);
        Module::firstOrCreate(['name'=>'unidades temáticas']);
    }
}
