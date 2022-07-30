<div x-data="data()">

    <x-shared.title title="Asignatura de: <b class='text-info'><i>{{ $subject->title }}</i></b>" />

    <x-subjects.submenu :subject="$subject" activeSection="contents" />


    {{-- PURPOSE SECTION --}}
    <div class="row mb-4">


        <div class="col-12">
            <h3 class="d-inline-block text-black">
                Propósito
            </h3>

            @if ($subject->is_updateable)
                <a href="" class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#editSubjectPurposeModalCenter">
                    <small><i class="fas fa-scroll mr-1"></i></small>
                    Definir
                </a>

                <!-- Modal -->
                <div class="modal fade" id="editSubjectPurposeModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="editSubjectPurposeModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="{{ route('subjects.purpose.update', [$subject]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="" class="text-muted">
                                            Definir propósito de la asignatura
                                        </label>
                                        <textarea name="subject_purpose" rows="7"
                                            class="form-control ckeditor">{!! $subject->purpose !!}</textarea>
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

            <div class="row mb-3">
                <div class="col-12">
                    <div class="kt-card">
                        <div class="card-body">
                            @if ($subject->purpose)
                                <span>
                                    {!! $subject->purpose !!}
                                </span>
                            @else
                                <x-shared.empty-box text="No se ha defindo el propósito de la asignatura" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END PURPOSE SECTION --}}

    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-black d-inline-block">Perfil del docente</h3>

            @if ($subject->is_updateable)
                {{-- select transversal axis button --}}
                <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#profesionalDisciplineModal">
                    <i class="fas fa-plus"></i> Seleccionar
                </button>
                {{-- end select transversal axis modal --}}


                {{-- select transversal axis button --}}
                <div class="modal fade" id="profesionalDisciplineModal" tabindex="-1" role="dialog"
                    aria-labelledby="profesionalDisciplineModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Perfil Profesional
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('subjects.professional-profiles.store', [$subject]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="text-muted"><small>NIVEL ACADÉMICO</small></label>
                                        <div>
                                            @foreach (academic_levels() as $academicLevelName)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="professional_profile_academic_level"
                                                        value="{{ $academicLevelName }}"
                                                        {{ $subject->professionalProfiles()->where('academic_level', $academicLevelName)->exists()
    ? 'checked'
    : '' }}>
                                                    <label class="form-check-label">{{ $academicLevelName }}</label>
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- <textarea class="form-control" name="professional_profile_academic_level" id=""
                                        cols="30"
                                        rows="3">{{ $subject->professionalProfiles()->exists() ? $subject->professionalProfiles()->first()->academic_level : '' }}</textarea> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="" class="text-muted"><small>EXPERIENCIA DOCENTE</small></label>

                                            <div class="input-group mb-3">
                                                {{-- <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> --}}
                                                <input type="number" class="form-control"
                                                    name="professional_profile_teaching_experience"
                                                    id="teacher_experience"
                                                    value="{{ $subject->professionalProfiles()->exists() ? $subject->professionalProfiles()->first()->teaching_experience : '0' }}"
                                                    min="0" max="100">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">años</span>
                                                </div>
                                            </div>

                                            {{-- <textarea class="form-control" name="professional_profile_teaching_experience" id="teacher_experience" cols="30" rows="3">{{  }}</textarea> --}}
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="" class="text-muted">
                                                <small>
                                                    EXPERIENCIA PROFESIONAL
                                                </small>
                                            </label>

                                            <div class="input-group mb-3">
                                                {{-- <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> --}}
                                                <input type="number" class="form-control"
                                                    name="professional_profile_professional_experience" id=""
                                                    value="{{ $subject->professionalProfiles()->exists() ? $subject->professionalProfiles()->first()->professional_experience : '0' }}"
                                                    min="0" max="100">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">años</span>
                                                </div>
                                            </div>

                                            {{-- <textarea class="form-control" name="professional_profile_professional_experience" id="" cols="30" rows="3">{{  }}</textarea> --}}
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm shadow-sm float-right">
                                        <i class="fas fa-save"></i>
                                        Guardar
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm float-right mr-2" data-dismiss="modal"
                                        aria-label="Close">
                                        <i class="fas fa-times"></i>
                                        Cancelar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end select transversal axis button --}}
            @endif


            <div class="row mb-4">
                <div class="col-12">
                    <div class="kt-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label for="" class="">Nivel académico</label><br>
                                    @if ($subject->professionalProfiles()->exists() && $subject->professionalProfiles()->first()->academic_level)
                                        <b>{{ $subject->professionalProfiles()->first()->academic_level }}</b>
                                    @else
                                        <b>N/A</b>
                                    @endif
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="" class="">Experiencia docente</label><br>
                                    @if ($subject->professionalProfiles()->exists() && $subject->professionalProfiles()->first()->teaching_experience)
                                        <b>{{ $subject->professionalProfiles()->first()->teaching_experience }}</b>
                                    @else
                                        <b>0</b>
                                    @endif
                                    años
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="" class="">Experiencia profesional</label><br>
                                    @if ($subject->professionalProfiles()->exists() && $subject->professionalProfiles()->first()->professional_experience)
                                        <b>{{ $subject->professionalProfiles()->first()->professional_experience }}</b>
                                    @else
                                        <b>0</b>
                                    @endif
                                    años
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- COMPETENCES SECTION --}}
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="d-inline-block text-black">
                Competencias profesionales
            </h3>

            @if ($subject->is_updateable)
                {{-- edit competences button --}}
                <a href="" class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#editCompetencesModalCenter">
                    <small><i class="fas fa-hand-pointer mr-1"></i></small>
                    Seleccionar
                </a>
                {{-- end edit competences button --}}

                {{-- select competences modal --}}
                <div class="modal fade" id="editCompetencesModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="editCompetencesModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCompetencesModalLongTitle">Competencias profesionales
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('subjects.competences.attach', [$subject]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">

                                        <h6 class="text-black">Competencias genéricas</h6>

                                        <div class="row">
                                            <div class="col-12">
                                                @if ($genericCompetences->isEmpty())
                                                    <div class="kt-card">
                                                        <div class="card-body">
                                                            <x-shared.empty-box
                                                                text="Ninguna competencia específica por mostrar" />
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="kt-table-responsive mb-3">
                                                        <table class="table">
                                                            <tbody>
                                                                @foreach ($genericCompetences as $competence)
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="flexCheckChecked"
                                                                                    name="competence_ids[]"
                                                                                    value="{{ $competence->id }}"
                                                                                    {{ $subject->hasCompetence($competence) ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="flexCheckChecked">
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            {{ $competence->description }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $competence->type }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>



                                        <h6 class="text-black">
                                            Competencias específicas
                                        </h6>

                                        <div class="row">
                                            <div class="col-12">
                                                @if ($specificCompetences->isEmpty())
                                                    <div class="kt-card">
                                                        <div class="card-body">
                                                            <x-shared.empty-box
                                                                text="Ninguna competencia específica por mostrar"
                                                                subtext="Las competencias específicas son listadas acorde al Plan de Estudios. Esta asignatura no cuenta con competencias específicas ya que no pertenece a algún Plan de Estudios." />
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="kt-table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                @foreach ($specificCompetences as $competence)
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="flexCheckChecked"
                                                                                    name="competence_ids[]"
                                                                                    value="{{ $competence->id }}"
                                                                                    {{ $subject->hasCompetence($competence) ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="flexCheckChecked">
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            {{ $competence->description }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $competence->type }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
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

            <div class="row mb-3">
                <div class="col-12">

                    {{-- subject's competences list --}}
                    @if ($subject->competences()->count())
                        <div class="row">
                            @foreach ($subject->competences as $competence)
                                <div class="col-12 mb-3">
                                    <div class="kt-card">
                                        <div class="card-body kt-border-left kt-border-secondary">
                                            <tr>
                                                {{ $competence->description }} <br>
                                                <span class="float-right badge badge-secondary">
                                                    {{ $competence->type }}
                                                </span>
                                            </tr>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="kt-card">
                            <div class="card-body">
                                <x-shared.empty-box text="Ninguna competencia profesional seleccionada" />
                            </div>
                        </div>
                    @endif
                    {{-- end subject's competences list --}}

                </div>
            </div>
            {{-- end select competences modal --}}
        </div>
    </div>
    {{-- END COMPETENCES SECTION --}}

    <div class="row mb-4">
        <div class="col-12">
            <h3 class="d-inline-block text-black">
                Unidades de competencias
            </h3>

            @if ($subject->is_updateable)
                <a class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#editCompetenceUnitsModalCenter">
                    <small><i class="fas fa-hand-pointer mr-1"></i></small>
                    Seleccionar
                </a>

                <!-- Modal -->
                <div class="modal fade" id="editCompetenceUnitsModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="editCompetenceUnitsModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="{{ route('subjects.competence-units.attach', [$subject]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">

                                        <h6 class="text-black">Unidades de Competencia</h6>

                                        <div class="row">
                                            <div class="col-12">
                                                @if ($competenceUnits->isEmpty())
                                                    <div class="kt-card">
                                                        <div class="card-body">
                                                            <x-shared.empty-box
                                                                text="Ninguna unidad de competencia por mostrar" subtext="Si estás viendo este mensaje es porque no has seleccionado competencias profesionales o las que has seleccionado no cuentan con unidades de competencia." />
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="kt-table-responsive mb-3">
                                                        <table class="table">
                                                            <tbody>
                                                                @foreach ($competenceUnits as $competenceUnit)
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="flexCheckChecked"
                                                                                    name="competence_unit_ids[]"
                                                                                    value="{{ $competenceUnit->id }}"
                                                                                    {{ $subject->hasCompetenceUnit($competenceUnit) ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="flexCheckChecked">
                                                                                </label>
                                                                            </div>
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
            @endif

            <div class="row mb-3">
                <div class="col-12">


                    {{-- subject's competences list --}}
                    @if ($subject->competenceUnits()->count())
                        <div class="row">
                            @foreach ($subject->competenceUnits as $competenceUnit)
                                <div class="col-12 mb-3">
                                    <div class="kt-card">
                                        <div class="card-body kt-border-left kt-border-secondary">
                                            {{ $competenceUnit->description }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="kt-card">
                            <div class="card-body">
                                <x-shared.empty-box text="Ninguna unidad de competencia seleccionada" />
                            </div>
                        </div>
                    @endif
                    {{-- end subject's competences list --}}

                </div>
            </div>

        </div>
    </div>

    <h3 class="d-inline-block text-black">
        Unidades temáticas
    </h3>

    @if ($subject->is_updateable)
        <a class="btn btn-info btn-sm float-right" href="{{ route('units.create', [$subject]) }}">
            <small><i class="fas fa-plus mr-1"></i></small>
            Crear Unidad
        </a>
    @endif


    <div class="row">
        @if ($subject->units()->exists())
            @foreach ($subject->units as $unit)
                <div class="col-12">
                    <div class="kt-card mb-3">
                        <div class="card-body kt-border-left kt-border-secondary">
                            <div class="mb-2">
                            </div>
                            <p class="nunito-font">{{ $unit->name }}</p>
                            <hr>
                            <div class="d-inline-block mr-1">
                                <a href="{{ route('units.show', [$unit]) }}" class="btn btn-primary btn-sm px-2">
                                    <i class="fas fa-eye"></i> Ver Detalles
                                </a>
                            </div>

                            @if ($subject->is_updateable)
                                <button class="btn btn-warning btn-sm shadow-sm mr-1" data-toggle="modal"
                                    data-target="#editUnit{{ $unit->id }}ModalCenter">
                                    <i class="fas fa-edit"></i> Editar
                                </button>

                                {{-- select unit modal --}}
                                <div class="modal fade" id="editUnit{{ $unit->id }}ModalCenter" tabindex="-1"
                                    role="dialog" aria-labelledby="editUnit{{ $unit->id }}ModalCenterTitle"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-xs modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editUnitModalLongTitle">Unidades temáticas</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('units.update', [$unit]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <label for="" class="text-muted text-uppercase">
                                                        Nombre
                                                    </label>

                                                    <input type="text" class="form-control mb-3" name="unit_name"
                                                        value="{{ $unit->name }}" required>

                                                    <div>
                                                        <button type="submit"
                                                            class="btn btn-sm shadow-sm btn-success float-right mr-1">
                                                            <i class="fas fa-save"></i> Guardar
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger float-right mr-1"
                                                            data-dismiss="modal">
                                                            <i class="fas fa-times"></i> Cancelar
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end edit unit modal --}}

                                <form action="{{ route('units.delete', [$unit]) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <div class="d-inline-block">
                                        <button type="submit" class="btn btn-outline-danger btn-sm px-2">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </form>
                            @endif



                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="kt-card">
                    <div class="card-body">
                        <x-shared.empty-box text="Ninguna unidad creada" />
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script defer>
        function data() {
            return {
                init() {

                    let minuteInputs = document.getElementsByClassName('minutes-text')

                    Array.from(document.getElementsByClassName("minutes-text")).forEach(function(input) {
                        input.innerText = MomentService.formatMinutes(input.innerText)
                    });
                },
            }
        }

        class MomentService {

            /**
             * format minutes integer to hours
             * even if it is more than 24 hours
             */
            static formatMinutes(minutes) {

                var dur = moment.duration(minutes, 'minutes');
                var hours = Math.floor(dur.asHours());
                hours = hours > 9 ? hours : "0" + hours;
                var mins = Math.floor(dur.asMinutes()) - hours * 60;
                mins = mins > 9 ? mins : "0" + mins
                var result = hours + ":" + mins;
                return result
            }
        }

    </script>

</div>
