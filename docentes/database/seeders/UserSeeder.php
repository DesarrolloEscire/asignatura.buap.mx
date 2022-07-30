<?php

namespace Database\Seeders;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\OfertaeResponsible;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate([
            'identifier' => 'NSS000000',
        ], [
            'name' => 'Cristian Emanuelle Guzmán Suárez',
            'email' => 'cguzman@ibsaweb.com',
            'password' => bcrypt('¡MyP4ssw0rd!'),
            'email_verified_at' => Carbon::now()
        ])->assignRole( Role::ADMINISTRATOR_ROLE );

        User::firstOrCreate([
            'identifier' => '100500144',
        ], [
            'name' => 'Paola Hernández Romero',
            'email' => 'paola.hernandez@correo.buap.mx',
            'password' => bcrypt('p40l4h3rn4nd3z'),
            'email_verified_at' => Carbon::now()
        ])->assignRole( Role::ADMINISTRATOR_ROLE );
        
        User::firstOrCreate([
            'identifier' => '100503111',
        ], [
            'name' => 'Korina Gutiérrez Ramírez',
            'email' => 'korina.gutierrez@correo.buap.mx',
            'password' => bcrypt('k0r1n4gut13rr3z'),
            'email_verified_at' => Carbon::now()
        ])->assignRole( Role::ADMINISTRATOR_ROLE );
        
        User::firstOrCreate([
            'identifier' => '100532305',
        ], [
            'name' => 'Marlene Palma Jiménez',
            'email' => 'marlenpj@correo.buap.mx',
            'password' => bcrypt('M4rl3n'),
            'email_verified_at' => Carbon::now()
        ])->assignRole( Role::ADMINISTRATOR_ROLE );
        
        User::firstOrCreate([
            'identifier' => '100503411',
        ], [
            'name' => 'Emilio Miguel Soto García',
            'email' => 'emilio.soto@correo.buap.mx',
            'password' => bcrypt('#13Bungee'),
            'email_verified_at' => Carbon::now()
        ])->assignRole( Role::ADMINISTRATOR_ROLE );

        Excel::import( new UsersImport, storage_path('imports/users.xlsx') );

    }
}
