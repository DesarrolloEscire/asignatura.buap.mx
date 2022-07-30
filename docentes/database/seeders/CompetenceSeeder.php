<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\OfertaeGenericCompetence;
use App\Models\OfertaeSpecificCompetence;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ofertaeSpecificCompetences = OfertaeSpecificCompetence::get();

        $ofertaeSpecificCompetences->map(function ($ofertaeSpecificCompetence) {

            $competence = Competence::firstOrCreate([
                'description' => $ofertaeSpecificCompetence->description,
                'type' => Competence::SPECIFIC_TYPE
            ]);

            if (!$ofertaeSpecificCompetence->educationalProgram) {
                return;
            }

            $competence
                ->educationalPrograms()
                ->sync([$ofertaeSpecificCompetence->educationalProgram->id]);
        });

        $ofertaeGenericCompetences = OfertaeGenericCompetence::get();

        $ofertaeGenericCompetences->map(function ($ofertaeGenericCompetence) {
            Competence::updateOrCreate([
                'description' => $ofertaeGenericCompetence->description,
            ], [
                'type' => Competence::GENERIC_TYPE,
                'units' => $ofertaeGenericCompetence->units
            ]);
        });
    }
}
