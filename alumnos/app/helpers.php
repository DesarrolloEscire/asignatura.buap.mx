<?php

use App\Src\Shared\Domain\BusinessException;
use App\Src\Shared\Domain\Command;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

if (!function_exists('strategies')) {
    function strategies(): array
    {
        return [
            'Aprendizaje Basado en Problemas',
            'Aprendizaje Basado en Proyectos',
            'Aprendizaje Colaborativo',
            'Aula Invertida',
            'Análisis de casos',
            'Debate o Foro de discusión guiado',
            'Ecosistemas de aprendizaje',
            'Ejercicios dentro de clase',
            'Ejercicios fuera del aula',
            'E-learning',
            'Enseñanza en pequeños grupos',
            'Exposición audiovisual',
            'Exposición oral',
            'Gamificación',
            'Lecturas obligatorias',
            'Portafolios y documentación de avances',
            'Prácticas de campo',
            'Prácticas de taller o laboratorio',
            'Recurso de aprendizaje abierto',
            'Seminarios',
            'Trabajo de investigación',
            'Trabajo en equipo experto-novato, y multitutoría',
            'Video-Conferencia con demostración oral y escrita',
        ];
    }
}

if (!function_exists('resources')) {
    function resources(): array
    {
        return [
            'Imágenes fijas proyectables (fotos)-diapositivas, fotografías',
            'Materiales manipulativos',
            'Materiales de laboratorio',
            'Materiales audiovisuales',
            'Materiales sonoros (audio): casetes, discos, programas de radio, podcast',
            'Materiales audiovisuales (vídeo) montajes audiovisuales, películas, vídeos, programas de televisión, diapositivas',
            'Páginas Web, Weblog, tours virtuales,  correo electrónico, chats, foros, unidades didácticas y cursos on-line',
            'Programas informáticos educativos: videojuegos, presentaciones multimedia, enciclopedias, animaciones y simulaciones interactivas',
            'Pizarra Digital',
            'Realidad Aumentada',
            'Textos Impresos o digitales: libros, revistas, periódicos, documentos, pdf interactivos, e-books, Proyectos, tesis y publicaciones científicas.',
        ];
    }
}

if (!function_exists('axes')) {
    function axes(): array
    {
        return [
            'Desarrollo de Habilidades del Pensamiento Complejo',
            'Desarrollo de Habilidades en el uso de la Tecnología de la Información y la Comunicación',
            'Educación para la Investigación',
            'Formación Humana y Social',
            'Innovación y Talento Universitario',
            'Lengua Extranjera',
        ];
    }
}

if (!function_exists('criteria')) {
    function criteria(): array
    {
        return [
            "Análisis crítico de artículos",
            "Análisis de caso ",
            "Asistencia ",
            "Ensayo ",
            "Exámenes ",
            "Exposición de seminarios por los alumnos",
            "Informe de prácticas ",
            "Lista de cotejo ",
            "Mapas conceptuales ",
            "Mapas mentales ",
            "Participación en clase ",
            "Portafolios ",
            "Preguntas y respuestas en clase",
            "Presentación en clase ",
            "Reportes de lectura",
            "Reportes de prácticas",
            "Solución de problemas",
            "Trabajos y tareas fuera del aula",
        ];
    }
}

if (!function_exists('synopsis')) {
    function synopsis(): array
    {
        return [
            'Actualización y/o enriquecimiento del Contenido Temático.',
            'Actualización y/o enriquecimiento de Técnicas y Estrategias Didácticas.',
            'Actualización y enriquecimiento de Recursos Didácticos.',
            'Actualización y enriquecimiento de Formas e Instrumentos de Evaluación.',
        ];
    }
}

if (!function_exists('instruments')) {
    function instruments(): array
    {
        return [
            'Análisis documental y de producciones (revisión de trabajos personales y grupales)',
            'Autoevaluación (mediante la autorreflexión y/o el análisis documental)',
            'Carpeta o dossier, carpeta colaborativa',
            'Control (examen)',
            'Cuaderno, cuaderno de notas, cuaderno de campo',
            'Cuestionarios',
            'Cuestionario',
            'Cuestionario oral',
            'Diario reflexivo, diario de clase',
            'Demostración, actuación o representación',
            'Debate, diálogo grupal',
            'Diario del profesor',
            'Diario de Clase',
            'Enlistar',
            'Estudio de casos',
            'Ensayo',
            'Evaluación entre pares (mediante el análisis documental y/o la observación)',
            'Evaluación compartida o colaborativa (mediante una entrevista individual o grupal entre el o la docente y los alumnos y alumnas)',
            'Exposición',
            'Escala de comprobación',
            'Escala de diferencial semántico',
            'Escalas de Estimación',
            'Foro virtual',
            'Foros',
            'Grupos Focales',
            'Guías de Observación',
            'Informe',
            'Listas de Cotejo',
            'Monografía',
            'Monografías',
            'Observación, observación directa del alumno, observación del grupo, observación sistemática, análisis de grabación de audio o video',
            'Organizadores gráficos',
            'Portafolio, portafolio electrónico',
            'Póster',
            'Proyecto',
            'Prueba objetiva',
            'Pruebas estandarizadas',
            'Ponencia',
            'Portafolio de evidencias',
            'Podcast',
            'Práctica supervisada',
            'Role-playing',
            'Rúbricas',
            'Reportes de lecturas',
            'Reporte de prácticas',
            'Test de diagnóstico',
            'Videos',
        ];
    }
}

if (!function_exists('evidences')) {
    function evidences(): array
    {
        return [
            'Bocetos',
            'Documento en editor de texto',
            'Documento en hoja de cálculo electrónica',
            'Ensayo',
            'Infografía',
            'Línea de tiempo',
            'Maqueta',
            'Monografía',
            'Organizadores Gráficos',
            'Portafolio Digital',
            'Portafolio de ejercicios',
            'Presentación Electrónica',
            'Producto disponible en algún recurso Web',
            'Prototipo',
            'Producto elaborado en Software educativo o especializado',
            'Reportes de Lectura',
            'Reporte de práctica',
            'Simulaciones',
        ];
    }
}

if (!function_exists('academic_levels')) {
    function academic_levels(): array
    {
        return [
            "Doctorado",
            "Licenciatura",
            "Maestría",
            "Técnico nivel 3",
            "Técnico superior universitario",
        ];
    }
}

if (!function_exists('transaction')) {
    function transaction(Command $command)
    {
        try {
            DB::transaction(function () use ($command) {
                $command
                    ->commandHandler()
                    ->handle($command);
            });
        } catch (BusinessException $e) {
            Alert::error($e->getMessage());
            abort(302, '', ['Location' => url()->previous()]);
        }
    }
}

/**
 * Redirects to REA platform
 * Output example: https://https://ecosistema.buap.mx/redirect?route=users.index
 * 
 */
if (!function_exists('external_route')) {
    function external_route(string $route, array $params = [])
    {
        $params = json_encode($params);

        return getenv('REA_BASE_URL')
            . "redirect"
            . "?route=$route"
            . "&params=$params";
    }
}
