<div x-data="data()">

    <x-shared.title title="Reporte de asignaturas aprobadas"
        subtitle="Lista de las asignaturas aprobadas y exportación a Excel" />

    <br>

    <div class="row">
        <div class="col-12">
            <div class="kt-table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Plan de estudios</th>
                            <th>Nombre de la asignatura</th>
                            <th>Programa de asignatura de nueva creación o actualización</th>
                            <th>Fecha de actualización o creación</th>
                            <th>Nombre(s) de autores o revisores</th>
                            <th>ID docente</th>
                            <th>Fecha de aprobación</th>
                            <th>Nombre del coordinador del área o coordinador o presidente de academia</th>
                            <th>Sinopsis de la revisión y/o actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td>
                                    @if ($subject->educationalPrograms()->exists())
                                        @foreach ($subject->educationalPrograms as $educationalProgram)
                                            {{ $educationalProgram->name }} <br>
                                        @endforeach
                                    @else
                                        Formación General Universitaria
                                    @endif
                                </td>
                                <td>{{ $subject->title }}
                                    @if ($subject->areas()->exists())
                                        {{ str_contains($subject->areas()->first()->name, 'Optativa') ? '(Optativa)' : '' }}
                                    @endif
                                </td>
                                <td>{{ ucfirst($subject->type) }}</td>
                                <td>{{ date_format($subject->created_at, 'd/m/Y') }}</td>
                                <td>
                                    <ol>
                                        @foreach ($subject->responsibles as $responsible)
                                            <li>{{ $responsible->name }} (Autor)</li>
                                        @endforeach
                                        @foreach ($subject->collaborators as $collaborator)
                                            <li>{{ $collaborator->name }} (Colaborador)</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>
                                    <ol>
                                        @foreach ($subject->responsibles as $responsible)
                                            <li>{{ $responsible->identifier }}</li>
                                        @endforeach
                                        @foreach ($subject->collaborators as $collaborator)
                                            <li>{{ $collaborator->identifier }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>{{ $subject->approved_at }}</td>
                                <td>{{ '-' }}</td>
                                <td>
                                    <ul>
                                        @foreach ($subject->synopsis as $synopsis)
                                            <li>{{ $synopsis->description }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function data($wire) {
            return {

            }
        }

    </script>

</div>
