<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evidence;

class EvidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evidence::firstOrCreate(['description' => 'Organizadores Gráficos']);
        Evidence::firstOrCreate(['description' => 'Reportes de Lectura']);
        Evidence::firstOrCreate(['description' => 'Reporte de práctica']);
        Evidence::firstOrCreate(['description' => 'Portafolio Digital']);
        Evidence::firstOrCreate(['description' => 'Portafolio de ejercicios']);
        Evidence::firstOrCreate(['description' => 'Ensayo']);
        Evidence::firstOrCreate(['description' => 'Infografía']);
        Evidence::firstOrCreate(['description' => 'Monografía']);
        Evidence::firstOrCreate(['description' => 'Presentación Electrónica']);
        Evidence::firstOrCreate(['description' => 'Documento en editor de texto']);
        Evidence::firstOrCreate(['description' => 'Documento en hoja de cálculo electrónica']);
        Evidence::firstOrCreate(['description' => 'Prototipo']);
        Evidence::firstOrCreate(['description' => 'Producto elaborado en Software educativo o especializado']);
        Evidence::firstOrCreate(['description' => 'Maqueta']);
        Evidence::firstOrCreate(['description' => 'Producto disponible en algún recurso Web']);
        Evidence::firstOrCreate(['description' => 'Línea de tiempo']);
        Evidence::firstOrCreate(['description' => 'Bocetos']);
    }
}
