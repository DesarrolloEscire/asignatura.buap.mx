<div x-data="data($wire)" wire:ignore>

    <x-shared.title title="Asignatura de: <b class='text-info'><i>{{ $subject->title }}</i></b>" />

    <x-subjects.submenu :subject="$subject" activeSection="teachers" />

    <div class="row mb-4">

        <div class="col-12 mb-3">
            <h3 class="text-black d-inline-block">
                Acción a realizar
            </h3>

            @if (auth()->user()->is_administrator ||
    auth()->user()->isResponsibleOfSubject($subject))
                <div class="d-inline-block float-right">
                    {{-- select transversal axis button --}}
                    <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                        data-target="#selectReviewSynopsisModal">
                        <i class="fas fa-plus"></i> seleccionar
                    </button>
                    {{-- end select transversal axis modal --}}

                    {{-- select transversal axis button --}}
                    <div class="modal fade" id="selectReviewSynopsisModal" tabindex="-1" role="dialog"
                        aria-labelledby="selectReviewSynopsisModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Tipo de programa de asignatura
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('subjects.update-status', [$subject]) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="kt-card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        :checked="subject.isModification()"
                                                                        x-on:change="onChangeStatus('modificación')"
                                                                        name="subject_type" value="modificación">
                                                                    <label class="form-check-label">
                                                                        modificación
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="subject_type" value="digitalización"
                                                                        x-ref="creationCheckbox"
                                                                        :checked="subject.isDigitalization()"
                                                                        x-on:change="onChangeStatus('digitalización')">
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Digitalización
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="subject_type" value="creación"
                                                                        x-ref="creationCheckbox"
                                                                        :checked="subject.isCreation()"
                                                                        x-on:change="onChangeStatus('creación')">
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio1">Nueva
                                                                        creación</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="subject_type" value="actualización"
                                                                        x-ref="updateCheckbox"
                                                                        :checked="subject.isUpdate()"
                                                                        x-on:change="onChangeStatus('actualización')">
                                                                    <label class="form-check-label"
                                                                        for="inlineRadio2">Actualización</label>
                                                                </div> <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div :class="showMessageBox ? 'mb-3' : 'd-none'" class="row">

                                            <div class="col-12 mb-2">
                                                <div class="kt-card">
                                                    <div class="card-body">
                                                        <x-shared.notification
                                                            message="Las modificaciones que solicites son realizadas por el administrador." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="kt-card">
                                                    <div class="card-body shadow">
                                                        <label class="text-muted">
                                                            Solicita tu la modificación
                                                        </label>
                                                        <textarea x-on:keyup="onModificationMessageUpdated()"
                                                            id="modificationMessage" name="message" rows="3"
                                                            class="form-control"
                                                            placeholder="escribe el motivo de la modificación"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div :class="showSinopsis ? '' : 'd-none'">
                                            <h5 class="text-black">
                                                Sinópsis de la revisión
                                            </h5>

                                            <div class="kt-table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        @foreach (synopsis() as $synopsisDescription)
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox"
                                                                        x-on:click="onSelectSinopsis()"
                                                                        name="synopsis_descriptions[]"
                                                                        {{ $subject->hasSynopsis($synopsisDescription) ? 'checked' : '' }}
                                                                        value="{{ $synopsisDescription }}">
                                                                </td>
                                                                <td>{{ $synopsisDescription }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <button type="submit" id="submitSubjectTypeButton"
                                            class="btn btn-success btn-sm shadow-sm float-right">
                                            <i class="fas fa-save"></i> guardar
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm float-right mr-2"
                                            data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-save"></i> cancelar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end select transversal axis button --}}
                </div>
            @endif


            <div class="row">
                <div class="col-12 mb-2">
                    <div class="kt-card">
                        <div class="card-body">
                            El programa de asignatura es <b>{{ $subject->type }}</b>.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TEACHER RESPONSIBLES --}}
        <div class="col-12 mb-3">
            <h3 class="d-inline-block text-black">Docente/s responsable/s</h3>

            @forelse ($responsibles as $responsible)
                <div class="kt-card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <label for="" class="text-muted">Nombre</label> <br>
                                <b>{{ $responsible ? strtoupper($responsible->name) : 'N/A' }}</b>
                            </div>
                            <div class="col-12 col-lg-4">
                                <label for="" class="text-muted">Correo</label> <br>
                                <b>{{ $responsible ? $responsible->email : 'N/A' }}</b>
                            </div>
                            <div class="col-12 col-lg-4">
                                <label for="" class="text-muted">ID</label> <br>
                                <b>{{ $responsible ? $responsible->identifier : 'N/A' }}</b>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="kt-card">
                    <div class="card-body">
                        <x-shared.empty-box text="Ningún docente responsable asociado a esta asignatura" />
                    </div>
                </div>
            @endforelse
        </div>

        {{--  --}}

        {{--  --}}

        <div class="col-12 mb-3">
            <h3 class="d-inline-block text-black">Autores</h3>

            @if ($subject->is_updateable)
                <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#selectCollaboratorModal">
                    <i class="fas fa-plus"></i> seleccionar
                </button>

                {{-- select collaborating teachers modal --}}
                <div class="modal fade" id="selectCollaboratorModal" tabindex="-1" role="dialog"
                    aria-labelledby="selectCollaboratorModal" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Seleccionar autores
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('subjects.collaborators.store', [$subject]) }}" method="POST">
                                    @csrf
                                    <x-selectors.teachers.authors :teachersSelected="$authors" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end select collaborating teachers modal --}}

            @endif


            <div class="row mb-3">
                <div class="col-12">
                    {{-- subject's competences list --}}
                    @if ($subject->collaborators()->exists())
                        <div class="row">
                            @foreach ($subject->collaborators as $collaborator)
                                <div class="col-12 mb-3">
                                    <div class="kt-card">
                                        <div class="card-body kt-border-left kt-border-secondary">
                                            <div class="row">
                                                <div class="col-12 col-lg-4">
                                                    <label for="" class="text-muted">
                                                        ID
                                                    </label> <br>
                                                    <b>{{ $collaborator->identifier }}</b>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <label for="" class="text-muted">
                                                        Nombre
                                                    </label> <br>
                                                    <b>{{ $collaborator->name }}</b>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <label for="" class="text-muted">
                                                        Email
                                                    </label> <br>
                                                    <b>{{ $collaborator->email }}</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="kt-card">
                            <div class="card-body">
                                <x-shared.empty-box text="Ningún autor seleccionado" />
                            </div>
                        </div>
                    @endif
                    {{-- end subject's competences list --}}

                </div>
            </div>

        </div>

        {{--  --}}

        @if (!$subject->is_creation)
            <div class="col-12 mb-3">
                <h3 class="d-inline-block text-black">Revisores</h3>

                @if ($subject->is_updateable)
                    <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                        data-target="#selectReviewerModal">
                        <i class="fas fa-plus"></i> seleccionar
                    </button>

                    {{-- select collaborating teachers modal --}}
                    <div class="modal fade" id="selectReviewerModal" tabindex="-1" role="dialog"
                        aria-labelledby="selectReviewerModal" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Seleccionar revisores
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('subjects.reviewers.store', [$subject]) }}" method="POST">
                                        @csrf
                                        <x-selectors.teachers.reviewers :reviewers="$reviewers" />
                                        {{-- @include('selectors.teachers',['teachersSelected' => $reviewers]) --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end select collaborating teachers modal --}}

                @endif

                <div class="row mb-3">
                    <div class="col-12">
                        {{-- subject's competences list --}}
                        @if ($subject->reviewers()->exists())
                            <div class="row">
                                @foreach ($subject->reviewers as $reviewer)
                                    <div class="col-12 mb-3">
                                        <div class="kt-card">
                                            <div class="card-body kt-border-left kt-border-secondary">
                                                <div class="row">
                                                    <div class="col-12 col-lg-4">
                                                        <label for="" class="text-muted">
                                                            ID
                                                        </label> <br>
                                                        <b>{{ $reviewer->identifier }}</b>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="" class="text-muted">
                                                            Nombre
                                                        </label> <br>
                                                        <b>{{ $reviewer->name }}</b>
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="" class="text-muted">
                                                            Email
                                                        </label> <br>
                                                        <b>{{ $reviewer->email }}</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="kt-card">
                                <div class="card-body">
                                    <x-shared.empty-box text="Ningún revisor seleccionado" />
                                </div>
                            </div>
                        @endif
                        {{-- end subject's competences list --}}

                    </div>
                </div>

                <div>
        @endif

        {{--  --}}



        @if (!$subject->is_creation && $subject->synopsis()->exists())
            <div class="col-12">
                <h3 class="text-black d-inline-block">Sinópsis de la revisión</h3>

                <div class="row">
                    @forelse ($subject->synopsis as $synopsis)
                        <div class="col-12 mb-3">
                            <div class="kt-card">
                                <div class="card-body kt-border-left kt-border-secondary">
                                    {{ $synopsis->description }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="kt-card">
                                <div class="card-body">
                                    <x-shared.empty-box text="No existe sinópsis de la revisión" />
                                </div>
                            </div>
                        </div>
                </div>
        @endforelse
    </div>
    @endif

</div>

<script>
    class SubjectTypeUI {

        static isThereAtLeatOneSinopsisSelected() {
            let checked = false;

            document.getElementsByName("synopsis_descriptions[]")
                .forEach(element => {
                    if (element.checked) {
                        checked = true
                    }
                });

            return checked
        }

        static isModificationMessageFilled() {
            console.log(document.getElementById("modificationMessage").value ? true : false)
            return document.getElementById("modificationMessage").value ? true : false
        }

        static disableSubmitButton() {
            console.log(document.getElementById('submitSubjectTypeButton'))
            document.getElementById('submitSubjectTypeButton').disabled = true
        }

        static enableSubmitButton() {
            document.getElementById('submitSubjectTypeButton').disabled = false
        }
    }

    class Subject {
        constructor(subject) {
            this.subject = subject
        }

        isCreation() {
            return this.subject.type == "creación"
        }

        isUpdate() {
            return this.subject.type == "actualización"
        }

        isDigitalization() {
            return this.subject.type == "digitalización"
        }

        isModification() {
            return this.subject.type == "modificación"
        }
    }

    function data($wire) {
        return {

            subject: undefined,
            showSinopsis: false,
            showMessageBox: false,
            teachers: @json($teachers),

            academicUnitSelected: @json($academicUnitSelected),
            allAcademicUnits: @json($allAcademicUnits),

            init() {
                this.subject = new Subject(@json($subject))

                this.onChangeStatus(this.subject.type)
            },

            onSelectSinopsis() {
                SubjectTypeUI.isThereAtLeatOneSinopsisSelected() ?
                    SubjectTypeUI.enableSubmitButton() :
                    SubjectTypeUI.disableSubmitButton()
            },

            onSelectUpdateType() {
                this.showSinopsis = true

                SubjectTypeUI.isThereAtLeatOneSinopsisSelected() ?
                    SubjectTypeUI.enableSubmitButton() :
                    SubjectTypeUI.disableSubmitButton()
            },

            onSelectModificationType() {
                this.showMessageBox = true

                SubjectTypeUI.isModificationMessageFilled() ?
                    SubjectTypeUI.enableSubmitButton() :
                    SubjectTypeUI.disableSubmitButton()
            },

            onModificationMessageUpdated() {
                SubjectTypeUI.isModificationMessageFilled() ?
                    SubjectTypeUI.enableSubmitButton() :
                    SubjectTypeUI.disableSubmitButton()
            },

            onChangeStatus(newStatus) {
                this.subject.type = newStatus

                this.showSinopsis = false
                this.showMessageBox = false
                SubjectTypeUI.enableSubmitButton()

                if (newStatus == 'actualización') {
                    this.onSelectUpdateType()
                    return
                }

                if (newStatus == 'modificación') {
                    this.onSelectModificationType()
                }

            },
        }
    }

</script>

</div>
