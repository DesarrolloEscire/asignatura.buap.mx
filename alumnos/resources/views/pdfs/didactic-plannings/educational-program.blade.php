<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Plan de estudios - ' . $subject->title }}</title>
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 12px;
            margin: 100px 60px 60px 60px;
            text-align: justify;
        }

        .courier-new-text {
            font-family: 'Courier New', Courier, monospace;
            font-size: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 10px;
        }

        table,
        td,
        th {
            border: 1px solid black;
            text-align: justify;
        }

        .text-center {
            text-align: center;
        }

        .mb {
            margin-bottom: 10px;
        }

        .bg-gray {
            background-color: #404246;
            color: white;
        }

        .border-gray {
            border-color: #404246;
        }

        .page_break {
            page-break-before: always;
        }

        /* units table */
        .units-table th:nth-child(1),
        .units-table td:nth-child(1) {
            width: 25%;
        }

        .units-table th:nth-child(2),
        .units-table td:nth-child(2) {
            width: 30%;
        }

        .units-table th:nth-child(3),
        .units-table td:nth-child(3) {
            width: 45%;
        }

        /* strategies-resources table */
        .strategies-resources th:nth-child(1),
        .strategies-resources td:nth-child(1),
        .strategies-resources th:nth-child(2),
        .strategies-resources td:nth-child(2) {
            width: 50%;
        }

        /* criteria table */
        .criteria th:nth-child(1),
        .criteria td:nth-child(1) {
            width: 85%;
        }

        .criteria th:nth-child(2),
        .criteria td:nth-child(2) {
            width: 15%;
            text-align: right;
        }

        .criteria .criteria-total {
            font-weight: bold;
            font-size: 15px;
        }

        .topic,
        .bibliography {
            list-style-type: none;
            padding: 0px;
        }

        .subtopic {
            list-style-type: none;
            padding: 0px 20px;
        }

        .bibliography ul {
            padding: 0px 20px;
        }

        html {}

        header {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: justify;
            display: flex;
            margin-bottom: 10px;
            color: #000080;
            font-size: 0px;
        }

        header div.content {
            float: left;
            font-size: 12px;
            display: flex;
            font-weight: bold;
        }

        .cover-page {
            font-size: 20px;
        }

        footer {
            position: fixed;
            bottom: 30px;
            left: 0px;
            right: 0px;
            height: 100px;
            color: gray;
            text-align: left;
        }

        footer hr {
            margin: 5px 0px;
            color: gray;
        }

        footer p {
            font-size: 7px;
            text-align: left;
            color: gray;
            height: 100px;
            width: 150%;
            display: flex;
        }

    </style>
</head>

<header class="header">
    <div class="content">
        <div><span style="margin:0px; padding:0px;">Benemérita Universidad Autónoma de Puebla</span></div>
        <div><i style="margin:0px; padding:0px;">Vicerrectoría de Docencia</i></div>
        <div><i style="margin:0px; padding:0px;">Dirección de Educación Superior</i></div>
        <div>
            <span style="margin:0px; padding:0px;">
                @foreach ($subject->academicUnits as $academicUnit)
                    {{ $academicUnit->name ?? '' }} ,
                @endforeach
            </span>
        </div>
        {{-- @endif --}}
    </div>
    <img width="10%" style="float: right; margin-left: 10px;"
        src="data:image/png;base64,' . {{ base64_encode(file_get_contents(public_path('img/institute.png'))) }} " />
</header>

<footer class="footer">
    {{-- <hr> --}}
    <span> <br> <br> <br> <br>
        <hr>
        El presente documento es Propiedad Intelectual de la Benemérita Universidad Autónoma de Puebla,
        conforme a lo previsto en el artículo 8 de su Ley y 137 del Estatuto Orgánico Universitario.
        La utilización del mismo, es para uso exclusivo de la Benemérita Universidad Autónoma de Puebla
        y los integrantes de la comunidad universitaria, en cumplimientos de los fines de docencia, investigación
        y extensión de la cultura. Queda estrictamente prohibida la reproducción total o parcial de su contenido o
        contenido o cualquier uso, distintos a los señalados en el párrafo anterior.
    </span>
    {{-- </p> --}}
</footer>

<body>
    <div class="mb cover-page">
        <br> <br> <br> <br>
        <b>PLAN DE ESTUDIOS: </b>
        @if ($subject->educationalPrograms()->exists())
            @foreach ($subject->educationalPrograms as $educationalProgram)
                {{ $educationalProgram->name }} <br>
            @endforeach
        @else
            Formación General Universitaria
        @endif
        <br> <br> <br>
        @if ($areaName)
            <b>ÁREA: </b> {{ $areaName }} <br> <br> <br> <br>
        @endif
        <b>ASIGNATURA: </b>{{ $subject->title }} <br> <br> <br> <br>
        <b>CÓDIGO: </b>{{ $subject->key }} <br> <br> <br> <br>
        <b>CRÉDITOS: </b>{{ $subject->credits }} <br> <br> <br> <br>
        <!-- <b>FECHA: </b> <br> <br> <br> <br> -->
    </div>

    <div class="page_break"></div>

    <!-- DATOS GENERALES -->
    <div class="mb">
        <b>DATOS GENERALES </b>
        <div class="mb">
            <table>
                <tbody>
                    <tr>
                        <td><b>Nombre del Plan de Estudios:</b></td>
                        <td>
                            @if ($subject->educationalPrograms()->exists())
                                @foreach ($subject->educationalPrograms as $educationalProgram)
                                    {{ $educationalProgram->name }},
                                @endforeach
                            @else
                                No registrado
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Modalidad Académica:</b></td>
                        <td>{{ $subject->educationalPrograms()->exists() ? $subject->educationalPrograms()->first()->modality : 'No registrado' }}
                        </td>
                    </tr>
                    <tr>
                        <td><b>Nombre de la Asignatura:</b></td>
                        <td>{{ $subject->title ?? 'No registrado' }} </td>
                    </tr>
                    <tr>
                        <td><b>Ubicación:</b></td>
                        <td>{{ $subject->level ?? 'No registrado' }}</td>
                    </tr>
                    <tr>
                        <td><b>Tipo de programa:</b></td>
                        <td>{{ $subject->type ?? 'No registrado' }}</td>
                    </tr>
                    <tr>
                        <td><b>Fecha de diseño de acta:</b></td>
                        <td>{{ !$subject->certificates()->exists() ? 'N/A' : $subject->certificates()->first()->designed_at ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td><b>Fecha de aprobación de acta:</b></td>
                        <td>{{ !$subject->certificates()->exists() ? 'N/A' : $subject->certificates()->first()->approved_at ?? 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td><b>Fecha de última actualización:</b></td>
                        <td>{{ !$subject->certificates()->exists() ? 'N/A' : $subject->certificates()->first()->last_update_at ?? 'N/A' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <!-- CARGA HORARIA DEL ESTUDIANTE -->
    <div class="mb">
        <b>CARGA HORARIA DEL ESTUDIANTE </b>
        <div class="mb">
            <table>
                <tbody>
                    <tr class="bg-gray border-gray">
                        <td rowspan="2"><b>Concepto</b></td>
                        <td colspan="2"><b> Horas por semana</b></td>
                        <td rowspan="2"><b>Total de horas por periodo</b></td>
                        <td rowspan="2"><b>Total de créditos por periodo</b></td>
                    </tr>
                    <tr class="bg-gray border-gray">
                        <td><b>Teoría</b></td>
                        <td><b>Práctica</b></td>
                    </tr>
                    <tr>
                        <td><b>Horas teoría y práctica</b></td>
                        <td class="text-center"><b>{{ $subject->theoretical_hours / 18 }}</b></td>
                        <td class="text-center"><b>{{ $subject->practical_hours / 18 }}</b></td>
                        <td class="text-center"><b>{{ $subject->hours }}</b></td>
                        <td class="text-center"><b>{{ $subject->credits }}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <!-- REVISIONES Y ACTUALIZACIONES -->
    <div class="mb">
        <b>REVISIONES Y ACTUALIZACIONES </b>
        <small></small>
        <div class="mb">
            <table>
                <tbody>
                    <tr>
                        <td>Responsable:</td>
                        <td>
                            @foreach ($subject->responsibles as $responsible)
                                {{ strtoupper($responsible->name) }}<br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Autores y/o revisores:</td>
                        <td>
                            @foreach ($collaborators as $collaborator)
                                {{ strtoupper($collaborator->name) }}<br>
                            @endforeach
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>Fecha de diseño:</td>
                        <td></td>
                    </tr> -->
                    <tr>
                        <td>Fecha de la última actualización</td>
                        <td>{{ date_format(date_create($subject->updated_at), 'd/m/Y') }}</td>
                    </tr>
                    <!-- <tr>
                        <td>Fecha de aprobación por parte de la academia de área, departamento u otro</td>
                        <td></td>
                    </tr> -->
                    <tr>
                        <td>Sinopsis de la revisión y/o actualización</td>
                        <td>{{ $synopsisList }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <!-- PERFIL DESEABLE DEL PROFESOR (A) PARA IMPARTIR LA ASIGNATURA -->
    <div class="mb">
        <b>PERFIL DESEABLE DEL PROFESOR (A) PARA IMPARTIR LA ASIGNATURA:</b>
        <div class="mb">
            <table>
                <tbody>
                    <!-- <tr>
                        <td>Disciplina profesional:</td>
                        <td></td>
                    </tr> -->
                    <tr>
                        <td>Nivel académico:</td>
                        <td>{{ $professionalProfile != null ? $professionalProfile->academic_level : 'No registrado' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Experiencia docente:</td>
                        <td>{{ $professionalProfile != null ? $professionalProfile->teaching_experience : 'No registrado' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Experiencia profesional:</td>
                        <td>{{ $professionalProfile != null ? $professionalProfile->professional_experience : 'No registrado' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <!-- PROPOSITO -->
    <div class="mb">
        <b>PROPÓSITO </b><br>
        <b>General</b>
        <div class="text-justify">{!! $subject->purpose ?? 'No registrado' !!}</div>
    </div>

    <br>
    <!-- COMPETENCIAS PROFESIONALES -->
    <div class="mb">
        <b>COMPETENCIAS PROFESIONALES:</b>
        <div class="mb">
            <table>
                <tbody>
                    <tr>
                        <td>
                            @if ($subject->competences()->exists())
                                <ul>
                                    @foreach ($subject->competences()->get() as $competence)
                                        <li>{{ $competence->description }}</li>
                                    @endforeach
                                </ul>
                            @else
                                No cuenta con competencias profesionales.
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="page_break"></div>
    <!-- CONTENIDOS TEMÁTICOS -->
    <div class="mb">
        <b>CONTENIDOS TEMÁTICOS </b>
        <div class="mb">
            @if ($subject->units()->exists())
                @foreach ($subject->units()->orderBy('id', 'ASC')->get() as $unitIndex => $unit)
                    <table class="units-table">
                        <thead>
                            <tr class="bg-gray border-gray">
                                <th>Unidad de Aprendizaje</th>
                                <th>Contenido Temático</th>
                                <th>Referencias</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span>{{ $unitIndex + 1 . '. ' . $unit->name }}</span>
                                </td>
                                <td>
                                    @if ($unit->topics()->exists())
                                        <ul class="topic">
                                            @foreach ($unit->topics()->orderBy('position', 'ASC')->get() as $topicIndex => $topic)
                                                <li>
                                                    {{ $unitIndex + 1 . '.' . ($topicIndex + 1) . '. ' . $topic->title }}
                                                    @if ($topic->subtopics()->exists())
                                                        <ul class="subtopic">
                                                            @foreach ($topic->subtopics()->orderBy('position', 'ASC')->get() as $subtopicIndex => $subtopic)
                                                                <li>
                                                                    {{ $unitIndex + 1 . '.' . ($topicIndex + 1) . '.' . ($subtopicIndex + 1) . '. ' . $subtopic->title }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td>
                                    @if ($unit->bibliographies()->exists())
                                        <ul class="bibliography">
                                            @foreach ($unit->bibliographies()->get() as $bibliography)
                                                <li>{!! $bibliography->content !!}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="page_break"></div>
                @endforeach
            @endif
        </div>
    </div>

    <br>
    <!-- ESTRATEGIAS, TÉCNICAS Y RECURSOS DIDÁCTICOS -->
    <div class="mb">
        <b>ESTRATEGIAS, TÉCNICAS Y RECURSOS DIDÁCTICOS </b>
        <div class="mb">
            <table class="strategies-resources">
                <thead>
                    <tr class="bg-gray border-gray">
                        <th>Estrategias y técnicas didácticas</th>
                        <th>Recursos didácticos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @if ($subject->strategies()->exists())
                                Estrategias de aprendizaje:
                                <ol>
                                    @foreach ($subject->strategies()->get() as $strategy)
                                        <li>{{ $strategy->description }}</li>
                                    @endforeach
                                </ol>
                                <br>
                            @else
                                No hay estrategias de aprendizaje registradas
                            @endif
                            <!-- Estrategias de enseñanza:
                            <ol>
                                <li>Activación de conocimientos previos</li>
                                <li>Generación de expectativas </li>
                                <li>Potenciar enlace entre los conocimientos previos y la nueva información</li>
                            </ol><br>
                            Ambientes de aprendizaje:
                            <p>La metodología de trabajo, los recursos didácticos y el diseño mismo del programa están pensados para facilitar el proceso de aprendizaje del estudiante. La organización de clase se prevé para un trabajo activo y un aprendizaje significativo y constructivo.</p>
                            <br>
                            Actividades y experiencias de aprendizaje:
                            Acciones que van a realizar, lugares que se van a visitar, analizar, entre otras.
                            <br>
                            <ol>
                                <li>Subrayado</li>
                                <li>Analogías, inferencias, resúmenes </li>
                                <li>Reconocimiento de categorías éticas especificas</li>
                                <li>preinterrogantes</li>
                                <li>preguntas insertadas Analogías</li>
                            </ol> -->
                        </td>
                        <td>
                            Recursos didácticos
                            @if ($subject->resources()->exists())
                                <ul>
                                    @foreach ($subject->resources()->get() as $resource)
                                        <li>{{ $resource->description }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <br>No hay recursos didácticos registrads
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <!-- EJES TRANSVERSALES -->
    @if (!$subject->is_fgu)
        <div class="mb">
            <b>EJES TRANSVERSALES </b>
            <div class="mb">
                <table>
                    <thead>
                        <tr class="bg-gray border-gray">
                            <th>Eje (s) transversales</th>
                            <!-- <th>Contribución con la asignatura </th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @if ($subject->axes()->exists())
                            @foreach ($subject->axes()->get() as $axis)
                                <tr>
                                    <td>{{ $axis->description }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center">No hay ejes transversales registrados</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <br>
    <!-- CRITERIOS DE EVALUACIÓN -->
    <div class="mb">
        <b>CRITERIOS DE EVALUACIÓN </b>
        <div class="mb">
            <table class="criteria">
                @if ($subject->criteria()->exists())
                    <thead>
                        <tr class="bg-gray border-gray">
                            <th>Criterios </th>
                            <th>Porcentaje </th>
                        </tr>
                    </thead>
                @endif
                <tbody>
                    @if ($subject->criteria()->exists())
                        @foreach ($subject->criteria as $criteria)
                            <tr>
                                <td>{{ $criteria->description }}</td>
                                <td>{{ $criteria->pivot->percentage }} %</td>
                            </tr>
                        @endforeach
                        <tr class="criteria-total">
                            <td> Total</td>
                            <td>{{ number_format($subject->criteria()->sum('percentage'), 2) }} %</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="2" class="text-center">Ningún criterio de evaluación propuesto</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
