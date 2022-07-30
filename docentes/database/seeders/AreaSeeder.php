<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\OfertaeArea;
use App\Models\EducationalProgram;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ofertaeAreas = OfertaeArea::get();

        $ofertaeAreas->map(function ($ofertaeArea) {
            $area = Area::updateOrCreate([
                'key' => $ofertaeArea->CVE,
            ], [
                'name' => $ofertaeArea->AREA
            ]);

            $area
                ->educationalPrograms()
                ->sync($this->getEducationalProgramId($ofertaeArea->PROGRAM_CODE));
        });
    }

    private function getEducationalProgramId($key)
    {
        return EducationalProgram::where('key', $key)->first() ?? NULL;
    }
}
