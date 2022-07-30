<?php

use App\Models\Competence;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;

class AddSomeCompetencesInFgusSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Subject::where('key', 'FGUS-004')
            ->orWhere('key', 'FGUS-005')
            ->orWhere('key', 'FGUS-006')
            ->orWhere('key', 'FGUS-007')
            ->get()
            ->each(function ($subject) {
                $this->_assignCompetence($subject);
            });

        Subject::where('key', 'ilike', 'FGUS-8%')->get()->each(function ($subject) {
            $this->_assignCompetence($subject);
        });

        Subject::where('key', 'ilike', 'FGUO%')->get()->each(function ($subject) {
            $genericCompetences = Competence::generic()->get();
            $subject
                ->possibleCompetences()
                ->syncWithoutDetaching($genericCompetences->pluck('id'));
        });

        Subject::where('key', 'FGUS-001')->get()->each(function ($subject) {
            $competence = Competence::where(
                'description',
                'ilike',
                '%Participa de manera comprometida%'
            )->first();

            $subject
                ->possibleCompetences()
                ->syncWithoutDetaching($competence->id);
        });

        Subject::where('key', 'FGUS-002')->get()->each(function ($subject) {
            $competence = Competence::where(
                'description',
                'ilike',
                '%Reflexiona y toma decisiones de manera crítica%'
            )->first();

            $subject
                ->possibleCompetences()
                ->syncWithoutDetaching($competence->id);
        });
    }

    private function _assignCompetence(Subject $subject)
    {
        $competence = Competence::where(
            'description',
            'ilike',
            '%utiliza una lengua extranjera de manera integral con la finalidad%'
        )->first();

        $subject
            ->possibleCompetences()
            ->syncWithoutDetaching($competence->id);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
