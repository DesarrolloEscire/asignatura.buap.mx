<?php

namespace Database\Seeders;

use App\Models\OfertaeResponsible;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ResponsibleSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ofertaeResponsibles = OfertaeResponsible::get();

        $ofertaeResponsibles->map(function ($ofertaeResponsible) {
            $user = $ofertaeResponsible->user;

            if (!$ofertaeResponsible->user) {
                return;
            }

            $subjects = OfertaeResponsible::where('ID', $user->identifier)
                ->get()
                ->pluck('subject')
                ->filter();


            try {
                $user->subjects()->sync($subjects->pluck('id')->toArray());
            } catch (\Throwable $th) {
                dd($subjects);
                throw $th;
            }
        });
    }
}
