<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 12px;
            margin: 60px 60px;
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
        }

        .mb {
            margin-bottom: 10px;
        }

        .bg-blue {
            background-color: #1f497d;
            color: white;
        }

        .bg-gray {
            background-color: #e3e4e6;
        }

        .border-blue {
            border-color: #1f497d;
        }

        .border-gray {
            border-color: #e3e4e6;
        }

        .page_break {
            page-break-before: always;
        }

        html {
            /* margin: 90px 90px; */
        }

        header {
            position: fixed;
            top: -30px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
        }


        footer {
            position: fixed;
            bottom: -20px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            /*line-height: 35px;*/
            font-size: 11px;
            font-weight: bold;
        }

    </style>
</head>

<header class="header" style="margin-bottom: 10px; color: black;">
    <div style="display: inline-block">
        <span>
            Benemérita Universidad Autónoma de Puebla | Vicerrectoria de Docencia | Dirección de Educación Superior
        </span>
        <br>
        <span>
            Facultad de Ingeniería | Planeación Didactica
        </span>
        <br>
    </div>
    <img width=" 10%" style="float: left; margin-right: 10px;"
        src="data:image/png;base64,' . {{ base64_encode(file_get_contents(public_path('img/institute.png'))) }} " />
</header>

<footer class="footer">
    <div style="font-size:8px">
        <p>
            Este documento es propiedad patrimonial de la Dirección General de Educación Superior de la Universidad
            Autónoma de Puebla y se ha elaborado para uso exclusivo del personal de la propia Universidad para los fines
            laborales que se le encomienda. Queda estrictamente
            prohibido cualquier otro uso, excluyéndose inclusive las limitaciones del art. 148 de la Ley Federal del
            Derecho de Autor(México) y sus correlativos en el extranjero
        </p>
    </div>
</footer>

<br><br>

<body>

    <div class="mb">
        <span>
            <span class="courier-new-text">ID Docente: </span>
            <b>{{ $responsibleIds }}</b>
        </span>
        <br>
        <span>
            <span class="courier-new-text">CÓDIGO DE LA ASIGNATURA: </span>
            <b>{{ $subject->key }}</b>
        </span>
        <br>
        <span class="courier-new-text">
            <span>NOMBRE DE LA ASIGNATURA:</span>
            <b>{{ $subject->title }}</b>
        </span>
    </div>
    <span class="courier-new-text">
        <span>ID Colaborador:</span>
        <b>{{ $collaboratorIds }}</b>
    </span>
    <br>
    <br>

    <div class="mb">
        <table class="border-blue">
            <thead>
                <tr class="bg-blue border-blue">
                    <th>
                        COMPETENCIAS RELACIONADAS CON EL PERFIL DE EGRESO
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-blue">
                        Competencia (s) Genérica (s): <br> <br>
                        <span style="color: gray">
                            @foreach ($genericCompetences as $competence)
                                <b>*</b> <i>{{ $competence->description }}</i> <br> <br>
                            @endforeach
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="border-blue">
                        Competencia (s) Específicas (s): (Se anexarán de acuerdo al plan de estudios) <br> <br>
                        <span style="color: gray">
                            @foreach ($specificCompetences as $competence)
                                <b>*</b> <i>{{ $competence->description }}</i> <br><br>
                            @endforeach
                        </span>
                    </td>
                </tr>
                <tr class="bg-blue border-blue">
                    <th>
                        UNIDAD DE COMPETENCIA
                    </th>
                </tr>
                <tr>
                    <td class="border-blue">
                        <span style="color: gray">
                            {{-- @foreach ($specificCompetences as $competence)
                                @if ($competence->units)
                                    <b>*</b> <i>{{ $competence->units }}</i> <br><br>
                                @endif
                            @endforeach
                            @foreach ($genericCompetences as $competence)
                                @if ($competence->units)
                                    <b>*</b> <i>{{ $competence->units }}</i> <br><br>
                                @endif
                            @endforeach --}}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="page_break"></div>

    @foreach ($subject->units as $unit)

        @if (!$unit->topics()->exists())
            <table style="margin: 10px 0px">
                <thead>
                    <tr>
                        <th class="text-center bg-gray border-gray">
                            <p>La unidad "{{$unit->name}}" No cuenta con contenido temático</p>
                        </th>
                    </tr>
                </thead>
            </table>
            <div class="page_break"></div>
        @endif

        {{-- TOPIC CONTEN TABLES --}}
        @foreach ($unit->topics()->orderBy('position')->get()
    as $topic)
            <div class="mb" width="50">
                <table class="">
                    <thead>
                        <tr>
                            <th class="bg-blue" colspan="2">Unidad/Taller</th>
                            <th class="bg-blue" colspan="2">Contenido temático</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                {{$unit->name}}
                            </td>
                            <td colspan="2">
                                {{$topic->title}}
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-blue">Actividad</td>
                            <td class="bg-blue">Competencia que se relaciona con la actividad</td>
                            <td class="bg-blue">Estrategias de Aprendizaje sugeridas</td>
                            <td class="bg-blue">Recursos y Materiales Didácticos sugeridos</td>
                        </tr>

                        <tr>
                            {{-- Activity --}}
                            <td class="">
                                @if ($topic->topicContents()->wherePlanning($planning)->whereNotNull('activity')->exists())
                                    {!! $topic->topicContents()->wherePlanning($planning)->first()->activity !!}
                                @else
                                    N/A
                                @endif
                            </td>

                            {{-- Competences --}}
                            <td class="">
                                @if ($topic->topicContents()->wherePlanning($planning)->has('competences')->exists())
                                    @foreach ($topic->topicContents()->wherePlanning($planning)->first()->competences
    as $competence)
                                        * {{ $competence->description }} <br>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>

                            {{-- Strategies --}}
                            <td class="">
                                @if ($topic->topicContents()->wherePlanning($planning)->has('strategies')->exists())
                                    @foreach ($topic->topicContents()->wherePlanning($planning)->first()->strategies
    as $strategy)
                                        * {{ $strategy->description }} <br>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>

                            {{-- Resources --}}
                            <td class="">
                                @if ($topic->topicContents()->wherePlanning($planning)->has('resources')->exists())
                                    @foreach ($topic->topicContents()->wherePlanning($planning)->first()->resources
    as $resource)
                                        * {{ $resource->description }} <br>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-blue" colspan="4">Duración en horas</th>
                        </tr>
                        <tr>
                            <th class="bg-blue" colspan="2">Teórico/Práctico</th>
                            <th class="bg-blue" colspan="1">Trabajo independiente del alumno</th>
                            <th class="bg-blue" colspan="1">Seguimiento de actividades por el docente</th>
                        </tr>
                        <tr>
                            {{-- THEORETICAL HOURS --}}
                            <td colspan="2">
                                @if ($topic->topicContents()->wherePlanning($planning)->exists())
                                    {{ $topic->topicContents()->wherePlanning($planning)->first()->theoretical_hours +
    $topic->topicContents()->wherePlanning($planning)->first()->practical_hours }}
                                    horas
                                @else
                                    0 horas
                                @endif
                            </td>

                            {{-- PRACTICAL HOURS --}}
                            <td colspan="1">
                                @if ($topic->topicContents()->wherePlanning($planning)->exists())
                                    {{ $topic->topicContents()->wherePlanning($planning)->first()->independent_hours }}
                                    horas
                                @else
                                    0 horas
                                @endif
                            </td>
                            <td colspan="1">
                                @if ($topic->topicContents()->wherePlanning($planning)->exists())
                                    {{ $topic->topicContents()->wherePlanning($planning)->first()->tracking_hours }}
                                    horas
                                @else
                                    0 horas
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-blue" colspan="4">Evaluación</th>
                        </tr>
                        <tr>
                            <th class="bg-blue" colspan="2">Evidencias</th>
                            <th class="bg-blue" colspan="1">Instrumentos</th>
                            <th class="bg-blue" colspan="1">Ponderación</th>
                        </tr>
                        <tr>
                            {{-- EVIDENCES --}}
                            <td colspan="2">
                                @if ($topic->topicContents()->wherePlanning($planning)->has('evidences')->exists())
                                    @foreach ($topic->topicContents()->wherePlanning($planning)->first()->evidences
    as $evidence)
                                        * {{ $evidence->description }} <br>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>
                            {{-- INSTRUMENTS --}}
                            <td colspan="1">
                                @if ($topic->topicContents()->wherePlanning($planning)->has('instruments')->exists())
                                    @foreach ($topic->topicContents()->wherePlanning($planning)->first()->instruments
    as $instrument)
                                        * {{ $instrument->description }} <br>
                                    @endforeach
                                @else
                                    N/A
                                @endif
                            </td>
                            {{-- WEIGHING --}}
                            <td colspan="1">
                                @if ($topic->topicContents()->wherePlanning($planning)->exists())
                                    {{ $topic->topicContents()->wherePlanning($planning)->first()->weighing }}
                                @else
                                    0.00
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="page_break"></div>

            {{-- SUBTOPIC CONTENT TABLES --}}
            @foreach ($topic->subtopics()->orderBy('position')->get() as $subtopic)
                <div class="mb" width="50">
                    <table class="">
                        <thead>
                            <tr>
                                <th class="bg-blue" colspan="2">Unidad/Taller</th>
                                <th class="bg-blue" colspan="2">Contenido temático</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">{{$unit->name}}</td>
                                <td colspan="2">{{$subtopic->title}}</td>
                            </tr>
                            <tr>
                                <td class="bg-blue">Actividad</td>
                                <td class="bg-blue">Competencia que se relaciona con la actividad</td>
                                <td class="bg-blue">Estrategias de Aprendizaje sugeridas</td>
                                <td class="bg-blue">Recursos y Materiales Didácticos sugeridos</td>
                            </tr>

                            <tr>
                                {{-- Activity --}}
                                <td class="">
                                    @if ($subtopic->subtopicContents()->wherePlanning($planning)->whereNotNull('activity')->exists())
                                        {!! $subtopic->subtopicContents()->wherePlanning($planning)->first()->activity !!}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                {{-- Competences --}}
                                <td class="">
                                    @if ($subtopic->subtopicContents()->wherePlanning($planning)->has('competences')->exists())
                                        @foreach ($subtopic->subtopicContents()->wherePlanning($planning)->first()->competences
    as $competence)
                                            * {{ $competence->description }} <br>
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>

                                {{-- Strategies --}}
                                <td class="">
                                    @if ($subtopic->subtopicContents()->wherePlanning($planning)->has('strategies')->exists())
                                        @foreach ($subtopic->subtopicContents()->wherePlanning($planning)->first()->strategies
    as $strategy)
                                            * {{ $strategy->description }} <br>
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>

                                {{-- Resources --}}
                                <td class="">
                                    @if ($subtopic->subtopicContents()->wherePlanning($planning)->has('resources')->exists())
                                        @foreach ($subtopic->subtopicContents()->wherePlanning($planning)->first()->resources
    as $resource)
                                            * {{ $resource->description }} <br>
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-blue" colspan="4">Duración en horas</th>
                            </tr>
                            <tr>
                                <th class="bg-blue" colspan="2">Teórico/Práctico</th>
                                <th class="bg-blue" colspan="2">Trabajo independiente del alumno</th>
                            </tr>
                            <tr>
                                {{-- THEORETICAL HOURS --}}
                                <td colspan="2">
                                    @if ($subtopic->subtopicContents()->wherePlanning($planning)->exists())
                                        {{ $subtopic->subtopicContents()->wherePlanning($planning)->first()->theoretical_hours +
    $subtopic->subtopicContents()->wherePlanning($planning)->first()->theoretical_hours }}
                                        horas
                                    @else
                                        0 horas
                                    @endif
                                </td>

                                {{-- PRACTICAL HOURS --}}
                                <td colspan="2">
                                    @if ($subtopic->subtopicContents()->wherePlanning($planning)->exists())
                                        {{ $subtopic->subtopicContents()->wherePlanning($planning)->first()->independent_hours }}
                                        horas
                                    @else
                                        0 horas
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-blue" colspan="4">Evaluación</th>
                            </tr>
                            <tr>
                                <th class="bg-blue" colspan="2">Evidencias</th>
                                <th class="bg-blue" colspan="1">Instrumentos</th>
                                <th class="bg-blue" colspan="1">Ponderación</th>
                            </tr>
                            <tr>
                                {{-- EVIDENCES --}}
                                <td colspan="2">
                                    @if ($subtopic->subtopicContents()->wherePlanning($planning)->has('evidences')->exists())
                                        @foreach ($subtopic->subtopicContents()->wherePlanning($planning)->first()->evidences
    as $evidence)
                                            * {{ $evidence->description }} <br>
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                {{-- INSTRUMENTS --}}
                                <td colspan="1">
                                    @if ($subtopic->subtopicContents()->wherePlanning($planning)->has('instruments')->exists())
                                        @foreach ($subtopic->subtopicContents()->wherePlanning($planning)->first()->instruments
    as $instrument)
                                            * {{ $instrument->description }} <br>
                                        @endforeach
                                    @else
                                        N/A
                                    @endif
                                </td>
                                {{-- WEIGHING --}}
                                <td colspan="1">
                                    @if ($subtopic->subtopicContents()->wherePlanning($planning)->exists())
                                        {{ $subtopic->subtopicContents()->wherePlanning($planning)->first()->weighing }}
                                    @else
                                        0.00
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="page_break"></div>
            @endforeach
        @endforeach
        {{-- END SUBTOPIC CONTENT TABLES --}}

    @endforeach

    {{-- END TOPIC CONTEN TABLES --}}

    </div>
    <br>

</body>

</html>
