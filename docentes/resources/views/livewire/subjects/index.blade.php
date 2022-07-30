<div x-data="data()">

    <x-shared.title title="Sección para el Responsable de la Captura de los Contenidos de Asignatura "
        subtitle="Responsables para subir contenidos" />

    <div class="row">
        <div class="col-12 col-md-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text border-0 shadow-sm" id="basic-addon1">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input type="text" class="form-control border-0 shadow-sm" placeholder="Buscar asignatura"
                    wire:model="searchTerm" aria-label="buscar asignatura" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>

    <div class="row">
        @if ($subjects->count())
            @foreach ($subjects as $subject)
                <div class="col-12 col-md-6">
                    <x-subjects.details :subject="$subject">
                        <div class="d-inline-block">
                            <a href="{{ route('subjects.teachers.show', [$subject]) }}"
                                class="btn btn-primary btn-sm px-2 shadow-sm">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                        </div>
                        @if ($subject->is_approved)
                            @if (auth()->user()->is_administrator || auth()->user()->isResponsibleOfSubject($subject))
                                <div class="d-inline-block float-right">
                                    <a target="_blank" href="{{ route('subjects.pdf', [$subject]) }}"
                                        data-toggle="tooltip" title="ver programa de asignatura"
                                        class="btn btn-danger btn-sm px-2 shadow-sm">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </div>
                            @endif

                        @else
                            @if (auth()->user()->is_administrator)
                                <div class="d-inline-block float-right">

                                    <button type="button" class="btn btn-info btn-sm px-2 shadow-sm mr-1"
                                        data-toggle="modal" data-target="#modalApproveSubject{{ $subject->id }}">
                                        <i class="fas fa-check-square"></i>
                                    </button>
                                    <x-modals.approve-subject :dynamic="true" :subject="$subject"></x-modals.approve-subject>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter{{ $subject->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenter{{ $subject->id }}Title"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    Revisar aprobación
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    @if (auth()->user()->is_administrator)

                                                        @foreach ($subject->subjectPrograms as $subjectProgram)
                                                            <div class="col-12">
                                                                <a target="_blank"
                                                                    href="{{ route('subject-programs.pdf', [$subjectProgram]) }}"
                                                                    class="text-info">
                                                                    programa de asignatura validado el
                                                                    {{ $subjectProgram->created_at }}
                                                                </a>
                                                            </div>
                                                        @endforeach

                                                        <div class="col-12">
                                                            <a target="_blank"
                                                                href="{{ route('subjects.pdf', [$subject]) }}">
                                                                ver programa de asignatura actual
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <hr>
                                                    <div class="col-12">
                                                        @if ($subject->certificates()->exists())
                                                            <a target="_blank"
                                                                href="{{ route('certificates.download', [$subject->certificates()->first()]) }}">
                                                                ver acta de validación
                                                            </a>
                                                        @else
                                                            <span class="text-muted">
                                                                No cuenta con acta de validación
                                                            </span>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('subjects.approve', [$subject]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-success btn-sm {{ $subject->certificates()->exists() ? '' : 'disabled' }}">
                                                        aprobar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <button type="button" class="float-right btn btn-info btn-sm px-2 shadow-sm mr-1"
                                data-toggle="modal" data-target="#modalSubjectObservatios_{{ $subject->id }}">
                                <i class="fas fa-eye"></i>
                                Ver observaciones ({{$subject->SubjectObservations->count()}})
                            </button>
                            <x-modals.subject-observations :subject="$subject"></x-modals.subject-observations>
                            <span class="float-right text-danger mr-2"><small>Materia sin aprobar</small></span>
                        @endif
                    </x-subjects.details>
                </div>
            @endforeach
        @endif
    </div>
    <div class="col-12">
        {{ $subjects->links() }}
    </div>
    @if (!$subjects->count())
        <div class="col-12">
            <div class="kt-card">
                <div class="card-body">
                    <x-shared.empty-box text="No eres responsable de ninguna asignatura." />
                </div>
            </div>
        </div>
    @endif

    <script>
        function data(){
            return {
                init(){
                    Swal.fire(
                        'Programa de asignatura',
                        'Descripción sintética de las asignaturas a fin de orientar en sus objetivos y contenido de manera concisa, sí como los mecanismos y criterios de evaluación.'
                    )
                }
            }
        }
    </script>

</div>
