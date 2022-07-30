<div x-data="data()" wire:ignore>
    <x-shared.title title="Contenidos de {{ $topicContent->topic->title }}" />

    <x-navigator :routes='[ "Planeación Didáctica de ".$topicContent->topic->unit->subjects()->first()->title =>  route("plannings.show", [$topicContent->planning]) ]'/>

    <div class="row mb-3">
        <div class="col-12">
            <div class="kt-card">
                <div class="card-body kt-border-left kt-border-primary" data-toggle="collapse" href="#collapseExample"
                    role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-caret-square-down float-right text-primary"
                        style="cursor: pointer; font-size: 22px" data-toggle="collapse" href="#collapseExample"
                        role="button" aria-expanded="false" aria-controls="collapseExample"></i>
                    usted está visualizando las actividades del tema/subtema: <br>
                    <b>{{ $topicContent->topic->title }}</b>
                </div>
            </div>
        </div>
    </div>

    <x-topics.submenu :planning="$topicContent->planning"
        :topics="$topicContent->topic->unit->topics()->orderBy('position')->get()"
        :activeTopic="$topicContent->topic" />

    {{-- HOURS --}}
    <div class="row mb-3">
        <div class="col-12">
            <h3 class="d-inline-block text-black">
                Horas asignadas
            </h3>

            @if (auth()->user()->isResponsibleOfPlanning($topicContent->planning))
                {{-- edit competences button --}}
                <a href="" class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#editHoursModalCenter">
                    <small><i class="fas fa-hand-pointer mr-1"></i></small>
                    Seleccionar
                </a>
                {{-- end edit competences button --}}

                {{-- select competences modal --}}
                <div class="modal fade" id="editHoursModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="editHoursModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCompetencesModalLongTitle">Horas asignadas
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="kt-card">
                                            <div class="card-body">
                                                Restan
                                                <b>{{ $topicContent->planning->remaining_theoretical_hours }}
                                                    horas</b>
                                                teóricas y
                                                <b>{{ $topicContent->planning->remaining_practical_hours }} horas</b>
                                                prácticas por asignar para completar las
                                                <b>{{ $topicContent->planning->subject->hours }} horas</b> totales
                                                contempladas para la asignatura
                                                <b>{{ $topicContent->planning->subject->title }}</b>.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form
                                    action="{{ route('contents.hours.update', [$topicContent->planning, $topicContent->topic]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-12 col-lg-2">
                                            <div class="kt-card mb-3">
                                                <div class="card-body">
                                                    Teoría
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                            name="theoretical_hours" placeholder="horas por periodo"
                                                            aria-label="horas por periodo" required
                                                            value="{{ $topicContent->theoretical_hours }}"
                                                            aria-describedby="basic-addon2" min="0" max="999">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                id="basic-addon2">horas</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="kt-card mb-3">
                                                <div class="card-body">
                                                    Práctica
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" name="practical_hours"
                                                            placeholder="horas por periodo"
                                                            aria-label="horas por periodo"
                                                            value="{{ $topicContent->practical_hours }}" required
                                                            aria-describedby="basic-addon2" min="0" max="999">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                id="basic-addon2">horas</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="kt-card mb-3">
                                                <div class="card-body">
                                                    Seguimiento de actividades por el docente
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                            placeholder="horas por periodo"
                                                            aria-label="horas por periodo" name="tracking_hours"
                                                            value="{{ $topicContent->tracking_hours }}" required
                                                            aria-describedby="basic-addon2" min="0" max="999">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                id="basic-addon2">horas</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="kt-card mb-3">
                                                <div class="card-body">
                                                    Trabajo independiente
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                            placeholder="horas por periodo"
                                                            aria-label="horas por periodo" name="independent_hours"
                                                            value="{{ $topicContent->independent_hours }}" required
                                                            aria-describedby="basic-addon2" min="0" max="999">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"
                                                                id="basic-addon2">horas</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-sm shadow-sm btn-success float-right mr-1">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger float-right mr-1"
                                            data-dismiss="modal">
                                            <i class="fas fa-times"></i> Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end edit competences modal --}}
            @endif
        </div>

        <div class="col-12 col-md-2">
            <div class="kt-card">
                <div class="card-body">
                    <label for="" class="text-muted"><small>Teoría</small></label><br>
                    <b>{{ $topicContent->theoretical_hours }}</b> horas
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="kt-card">
                <div class="card-body">
                    <label for="" class="text-muted"><small>Prácticas / Laboratorio</small></label><br>
                    <b>{{ $topicContent->practical_hours }}</b> horas
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="kt-card">
                <div class="card-body">
                    <label for="" class="text-muted"><small>Seguimiento de actividades por el
                            docente</small></label><br>
                    <b>{{ $topicContent->tracking_hours }}</b> horas
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="kt-card">
                <div class="card-body">
                    <label for="" class="text-muted"><small>Trabajo independiente del alumno</small></label><br>
                    <b>{{ $topicContent->independent_hours }}</b> horas
                </div>
            </div>
        </div>

    </div>
    {{-- END HOURS --}}

    <div class="row mb-3">
        <div class="col-12">

            <h3 class="d-inline-block text-black">Actividad de aprendizaje</h3> <span class="text-muted">(Describa sus
                actividades de aprendizaje o coloque el enlace o link de su Recurso de Aprendizaje Abierto)</span>

            @if (auth()->user()->isResponsibleOfPlanning($topicContent->planning))
                <a href="" class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#editTopicActivityModalCenter">
                    <small><i class="fas fa-scroll mr-1"></i></small>
                    Definir
                </a>

                <!-- Modal -->
                <div class="modal fade" id="editTopicActivityModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="editTopicActivityModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form
                                    action="{{ route('plannings.topics.activity.update', [$topicContent->planning, $topicContent->topic]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="" class="text-muted">
                                            Definir Actividad de Aprendizaje
                                        </label>
                                        <textarea name="activity" rows="7"
                                            class="form-control ckeditor">{!! $topicContent->activity !!}</textarea>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-sm shadow-sm btn-success float-right mr-1">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger float-right mr-1"
                                            data-dismiss="modal">
                                            <i class="fas fa-times"></i> Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="kt-card">
                <div class="card-body">
                    @if ($topicContent->activity)
                        {!! $topicContent->activity !!}
                    @else
                        <x-shared.empty-box text="No se ha definida la actividad de aprendizaje." />
                    @endif
                </div>
            </div>
        </div>
    </div>

    

    {{-- UNIT COMPETENCES --}}

    <div class="row mb-3">
        <div class="col-12">
            <h3 class="d-inline-block text-black">
                Unidades de Competencias
            </h3>

            @if (auth()->user()->isResponsibleOfPlanning($topicContent->planning))
                {{-- edit competences button --}}
                <a href="" class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#editCompetenceUnitsModalCenter">
                    <small><i class="fas fa-hand-pointer mr-1"></i></small>
                    Seleccionar
                </a>

                <!-- Modal -->
                <div class="modal fade" id="editCompetenceUnitsModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="editCompetenceUnitsModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCompetenceUnitsModalCenterTitle">
                                    Unidades de Competencia
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form
                                    action="{{ route('plannings.topics.competence-units.attach', [$topicContent->planning, $topicContent->topic]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            @if ($competenceUnits->isEmpty())
                                                <div class="kt-card">
                                                    <div class="card-body">
                                                        <x-shared.empty-box
                                                            text="Ninguna Unidad de Competencias por mostrar" />
                                                    </div>
                                                </div>
                                            @else
                                                <div class="kt-table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach ($competenceUnits as $competenceUnit)
                                                                <tr>
                                                                    <td>
                                                                        <input type="checkbox" name="competence_unit_ids[]" value="{{$competenceUnit->id}}"
                                                                            {{ $topicContent->hasCompetenceUnit($competenceUnit) ? 'checked' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        {{ $competenceUnit->description }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-dismiss="modal">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <button class="btn btn-success btn-sm shadow-sm">
                                                <small><i class="fas fa-save"></i></small>
                                                guardar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            <div class="row">
                @forelse ($topicContent->competenceUnits as $competenceUnit)
                    <div class="col-12">
                        <div class="kt-card">
                            <div class="card-body kt-border-left kt-border-secondary">
                                {{ $competenceUnit->description }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="kt-card">
                            <div class="card-body">
                                <x-shared.empty-box text="Ninguna Unidad de Competencias seleccionada" />
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    {{-- MATERIALS --}}

    <div class="mb-4">
        <div class="row">
            <div class="col-12">

                <h3 class="text-black d-inline-block">
                    Material y equipo necesario
                </h3>

                @if (auth()->user()->isResponsibleOfPlanning($topicContent->planning))
                    {{-- select transversal axis button --}}
                    <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                        data-target="#materialAndEquipmentModal">
                        <i class="fas fa-plus"></i> Seleccionar
                    </button>
                    {{-- end select transversal axis modal --}}

                    {{-- SELECT MATERIALS MODAL --}}
                    <div class="modal fade" id="materialAndEquipmentModal" tabindex="-1" role="dialog"
                        aria-labelledby="materialAndEquipmentModal" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Material y equipo necesario
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="{{ route('plannings.topics.materials.update', [$topicContent->planning, $topicContent->topic]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="" class="text-muted">describir materiales</label>
                                                <textarea name="materials" class="form-control"
                                                    rows="2">{{ $topicContent->materials }}</textarea>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="" class="text-muted">describir equipo</label>
                                                <textarea name="equipment" class="form-control"
                                                    rows="2">{{ $topicContent->equipment }}</textarea>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="" class="text-muted">describir seguridad</label>
                                                <textarea name="security" class="form-control"
                                                    rows="2">{{ $topicContent->security }}</textarea>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success btn-sm shadow-sm float-right">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm float-right mr-2"
                                            data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-save"></i> Cancelar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end SELECT MATERIALS MODAL --}}

                @endif

            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="kt-card h-100">
                    <div class="card-body">
                        @if ($topicContent->materials)
                            <span>{{ $topicContent->materials }}</span>
                        @else
                            <x-shared.empty-box text="Ningún material" />
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="kt-card h-100">
                    <div class="card-body">
                        @if ($topicContent->equipment)
                            <span>{{ $topicContent->equipment }}</span>
                        @else
                            <x-shared.empty-box text="Ningún equipo" />
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="kt-card h-100">
                    <div class="card-body">
                        @if ($topicContent->security)
                            <span>{{ $topicContent->security }}</span>
                        @else
                            <x-shared.empty-box text="Ninguna seguridad" />
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- END MATERIALS --}}

    <script>
        function data() {
            return {
                init() {

                }
            }
        }

    </script>

</div>
