<?php

use App\Models\Competence;
use App\Models\CompetenceUnit;
use App\Models\EducationalProgram;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FillCompetenceUnits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // =========
        // ADI-2021
        // =========

        $competence = Competence::firstWhere('description', 'ilike', 'Analiza la naturaleza del movimiento y la imagen para comunicar historias%');

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Identifica las características del movimiento y la imagen con la finalidad de llevar a cabo la propia interpretación de éstos'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Expresa ideas y emociones para comunicar mensajes por medio de producciones verbales, no verbales y/o gráficas.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Distingue las diferentes técnicas y teorias de las artes visuales para crear representaciones gráficas a través de distintos medios de producción.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Experimenta con diversas técnicas y materiales de las artes visuales para crear representaciones bi y tridimensionales aplicando sus conocimientos teóricos.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Examina las tendencias y las manifestaciones artísticas en su entorno para crear reflexiones estéticas empleando diversas teorías de las artes visuales.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        EducationalProgram::where('key', 'ilike', 'ADI-2021')->get()->each(function ($educationalProgram) use ($competence) {
            $educationalProgram->competences()->syncWithoutDetaching($competence->id);
        });

        // =========
        // ADI-2021
        // =========

        $competence = Competence::firstWhere('description', 'ilike', 'Sistematiza los elementos de experiencias audiovisuales y/o interactivas para crear%');

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Identifica las características de problemas abstractos de naturaleza matemática para desarrollar un pensamiento lógico reproduciendo patrones y conceptos propios del área.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Reconoce los elementos de diversas experiencias audiovisuales digitales para generar interes para desarrollar...  mediante herramientas de cómputo.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Experimenta con herramientas digitales orientadas a la creación de vivencias interactivas para realizar productos artísticos y de entretenimiento.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Implementa metodologías ágiles a sus procesos de producción para construir videojuegos, simulaciones por computadora y expresiones artísticas, a través del uso profesional de herramientas y técnicas digitales.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Aplica sus conocimientos y experiencia adquirida mediante el proceso de creación de obras audiovisuales, expresivas y lúdicas.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        EducationalProgram::where('key', 'ilike', 'ADI-2021')->get()->each(function ($educationalProgram) use ($competence) {
            $educationalProgram->competences()->syncWithoutDetaching($competence->id);
        });
        
        // =========
        // APL-2021
        // =========

        $competence = Competence::firstWhere('description', 'ilike', 'Emplea el vocabulario y los conceptos propios de cada técnica artística particular%');

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Examina cada técnica artísitica y su lenguaje a partir de sus características para su aplicación en la creación de obras plásticas o audiovisuales.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => ' Identifica conceptos y teorías de las diferentes técnicas artísticas y sus medios para comprender los usos y cambios que han tenido a través de la historia.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Diferencia cada ténica artistica, sus teorías y lenguajes con el propósito de distinguir y comprender el uso que tiene cada una de ellas al referirse a una obra plástica o audiovisual.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Selecciona técnicas y conceptos específicos desde una visión interdisiciplinaria para aplicarlos en la creación, producción y difusión de obras plásticas y audiovisuales.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        EducationalProgram::where('key', 'ilike', 'APL-2021')->get()->each(function ($educationalProgram) use ($competence) {
            $educationalProgram->competences()->syncWithoutDetaching($competence->id);
        });
        
        // =========
        // APL-2021
        // =========

        $competence = Competence::firstWhere('description', 'ilike', 'Valora los métodos artísticos que pueden aplicarse convenientemente al desarrollo%');

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Identifica los metodos y técnicas artísiticas, a partir de los procesos de creación, para comprender su metodología en el desarrollo de proyectos artísticos y culturales.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Expresa empatia y tolerancia  ante  la multiculturalidad, a partir del uso de métodos y técnicas específicas para la creación artística.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Analiza las transforaciones del campo artísitico para participar en su desarrollo a través del uso de métodos artísticos con la intención de fomentar la multiculturalidad, empatía y tolerancia ante la diversidad.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Formula y desarrolla proyectos socioclturales, artísticos y/o de intervención a partir de métodos artísticos que fomenten el cambio social  desde la multiculturalidad, empatía y tolerancia.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        EducationalProgram::where('key', 'ilike', 'APL-2021')->get()->each(function ($educationalProgram) use ($competence) {
            $educationalProgram->competences()->syncWithoutDetaching($competence->id);
        });
        
        // =========
        // CIN-2021
        // =========

        $competence = Competence::firstWhere('description', 'ilike', 'Valora los procesos históricos, técnicos y estéticos %');

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Identifica procesos históricos, técnicos y/o estéticos de la imagen movimiento y sonido como expresión artística, industria y/o fenómeno social'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Describe los diversos procesos históricos, técnicos y/o  estéticos de la imagen movimiento y sonido como expresión artística, industria y/o fenómeno social.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Asocia procesos históricos, técnicos y/o  estéticos de la imagen movimiento y sonido como expresión artística, industria y/o fenómeno social comprendiendo que son resultado del desarrollo cultural y tecnológico.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        $competenceUnit = CompetenceUnit::firstOrCreate([
            'description' => 'Integra los conceptos técnicos y estéticos de la imagen en movimiento y sonido a partir de sus procesos históricos, técnicos y/o  estéticos como industria, fenómeno social y expresión artística.'
        ]);

        $competence->competenceUnits()->syncWithoutDetaching($competenceUnit);

        EducationalProgram::where('key', 'ilike', 'CIN-2021')->get()->each(function ($educationalProgram) use ($competence) {
            $educationalProgram->competences()->syncWithoutDetaching($competence->id);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
