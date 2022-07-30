<?php

namespace Database\Seeders;

use App\Imports\StudentImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('imports/students.xlsx');
        Excel::import( new StudentImport, $path );
    }
}
