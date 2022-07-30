<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instrument;

class InstrumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instrument::firstOrCreate(['description' => 'Portafolio de evidencias']);
        Instrument::firstOrCreate(['description' => 'Ensayo']);
        Instrument::firstOrCreate(['description' => 'Podcast']);
        Instrument::firstOrCreate(['description' => 'Videos']);
        Instrument::firstOrCreate(['description' => 'Organizadores gráficos']);
        Instrument::firstOrCreate(['description' => 'Listas de Cotejo']);
        Instrument::firstOrCreate(['description' => 'Rúbricas']);
        Instrument::firstOrCreate(['description' => 'Pruebas estandarizadas']);
        Instrument::firstOrCreate(['description' => 'Cuestionarios']);
        Instrument::firstOrCreate(['description' => 'Foros']);
        Instrument::firstOrCreate(['description' => 'Grupos Focales']);
        Instrument::firstOrCreate(['description' => 'Diario de Clase']);
        Instrument::firstOrCreate(['description' => 'Reportes de lecturas']);
        Instrument::firstOrCreate(['description' => 'Reporte de prácticas']);
        Instrument::firstOrCreate(['description' => 'Guías de Observación']);
        Instrument::firstOrCreate(['description' => 'Monografías']);
        Instrument::firstOrCreate(['description' => 'Escalas de Estimación']);
    }
}
