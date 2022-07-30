<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\OfertaeSubject;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ofertaeSubjects = OfertaeSubject::get();

        $ofertaeSubjects->map(function ($ofertaeSubject) {
            $subject = Subject::where('key', $ofertaeSubject->cve_materia)->first();
            $subject->areas()->sync($ofertaeSubject->area->id);
        });
    }
}
