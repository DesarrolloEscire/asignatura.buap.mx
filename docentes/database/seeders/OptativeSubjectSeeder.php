<?php

namespace Database\Seeders;

use App\Models\AcademicUnit;
use App\Models\EducationalProgram;
use App\Models\OfertaeModality;
use App\Models\OfertaeOptativeSubject;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class OptativeSubjectSeeder extends Seeder
{
    const FACTOR_HOURS_PERIOD = 18;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ofertaeSubjects = OfertaeOptativeSubject::get();

        $ofertaeSubjects->map(function ($ofertaeSubject) {

            $academicUnit = AcademicUnit::updateOrCreate([
                'key' => $ofertaeSubject->academic_unit_key
            ], [
                'name' => $ofertaeSubject->academic_unit_name
            ]);

            $educationalProgram = EducationalProgram::updateOrCreate([
                'key' => $ofertaeSubject->program_key
            ], [
                'name' => $ofertaeSubject->program_description,
                'modality' => $this->modalityOfProgram($ofertaeSubject->program_key)
            ]);

            $subject = $this->updateOrCreateSubject($ofertaeSubject);

            $subject
                ->educationalPrograms()
                ->sync([$educationalProgram->id]);

            $subject
                ->academicUnits()
                ->sync([$academicUnit->id]);

            $educationalProgram
                ->academicUnits()
                ->syncWithoutDetaching([$academicUnit->id]);
        });
    }

    private function updateOrCreateSubject(OfertaeOptativeSubject $ofertaeSubject): Subject
    {
        $subject = Subject::where('key', $ofertaeSubject->key)
            ->whereEducationalProgram($ofertaeSubject->educationalProgram)
            ->whereAcademicUnit($ofertaeSubject->academicUnit)
            ->first();

        if (!$subject) {
            return Subject::create([
                'key' => $ofertaeSubject->key,
                'title' => $ofertaeSubject->name,
                'type' => Subject::CREATION_TYPE,
                'theoretical_hours' => $ofertaeSubject->theoretical_hours,
                'practical_hours' => $ofertaeSubject->practical_hours,
                'level' => $ofertaeSubject->level,
                'credits' => $ofertaeSubject->credits,
            ]);
        }

        $subject->update([
            'title' => $ofertaeSubject->name,
            'theoretical_hours' => $ofertaeSubject->theoretical_hours,
            'practical_hours' => $ofertaeSubject->practical_hours,
            'level' => $ofertaeSubject->level,
            'credits' => $ofertaeSubject->credits,
        ]);

        return $subject;
    }

    private function modalityOfProgram(?string $programKey)
    {
        if (!$programKey) {
            return null;
        }

        $ofertaeModality = OfertaeModality::whereProgramKey($programKey)->first();

        if (!$ofertaeModality) {
            return null;
        }

        return $ofertaeModality->modality;
    }
}
