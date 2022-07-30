<div x-data="data()" wire:ignore>

    <x-shared.title title="Planeación didáctica de {{ $planning->subject->title }}" />

    <div class="row mb-2">
        <div class="col-12">
            <small><i class="fas fa-globe"></i></small>
            <a href="{{ route('subjects.plannings.index', [$planning->subject]) }}" class="text-primary">
                Lista de Planeaciones Didácticas
            </a>
            /
        </div>
    </div>

    @if (!$planning->is_published &&
    $planning->users()->whereUser(auth()->user())->exists())
        <div class="row">
            <div class="col-12 mb-3">
                <x-shared.notification
                    message="La planeación aún no está publicada. Cuando hayas llenado las actividades, puedes presionar el botón publicar para hacer visible tu planeación.">
                    <form action="{{ route('plannings.publish', [$planning]) }}" class="d-inline" method="POST">
                        @csrf
                        <button class="btn btn-success btn-sm shadow-sm float-right">
                            publicar
                        </button>
                    </form>
                </x-shared.notification>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="text-black d-inline">Coautores</h3>

            @if (auth()->user()->isResponsibleOfPlanning($planning))
                <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#selectCollaboratorModal">
                    <i class="fas fa-plus"></i> invitar usuarios
                </button>

                {{-- select users modal --}}
                <div class="modal fade" id="selectCollaboratorModal" tabindex="-1" role="dialog"
                    aria-labelledby="selectCollaboratorModal" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Seleccionar usuarios
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('plannings.users.attach', [$planning]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-0 shadow-sm" id="basic-addon1">
                                                        <i class="fas fa-search"></i>
                                                    </span>
                                                </div>
                                                <input id="identifier-search-input"
                                                    class="form-control border-0 shadow-sm"
                                                    placeholder="Buscar autor y/o revisor" x-on:keyup="onSearchUser()"
                                                    aria-label="buscar asignatura" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="text-black">
                                        Lista de docentes con cuenta de usuario
                                    </h5>

                                    <div class="kt-table-responsive mb-3" style="max-height: 400px; overflow-y: scroll">
                                        <table class="kt-table">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>nombre</th>
                                                    <th>email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template x-for="user in users">
                                                    <tr x-on:click="onSelectUser($event, user)" style="cursor: pointer">
                                                        <td x-text="user.identifier"></td>
                                                        <td x-text="user.name"></td>
                                                        <td x-text="user.email"></td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>

                                    <h5 class="text-black">
                                        Lista de docentes colaboradores que serán invitados
                                    </h5>

                                    <div class="kt-table-responsive mb-3" style="max-height: 400px; overflow-y: scroll">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>id</th>
                                                    <th>nombre</th>
                                                    <th>email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template x-for="user in usersSelected" :key="user.id">
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="user_ids[]" :value="user.id"
                                                                checked x-on:click="onUnselectUser(user)">
                                                        </td>
                                                        <td x-text="user.identifier"></td>
                                                        <td x-text="user.name"></td>
                                                        <td x-text="user.email"></td>
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-sm shadow-sm float-right">
                                        <small class="mr-1"><i class="fas fa-envelope"></i></small> Invitar
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
                {{-- end select users modal --}}

            @endif
        </div>
        @forelse ($userCollaborators as $user)
            <div class="col-12">
                <div class="kt-card mb-3">
                    <div class="card-body kt-border-left kt-border-secondary">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label for="" class="text-muted">
                                    <small>Nombre</small><br>
                                    <b>{{ strtoupper($user->name) }}</b>
                                </label>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="" class="text-muted">
                                    <small>ID</small><br>
                                    <b>{{ $user->identifier }}</b>
                                </label>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="" class="text-muted">
                                    <small>Correo electrónico</small><br>
                                    <b>{{ $user->email }}</b>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 mb-3">
                <div class="kt-card">
                    <div class="card-body">
                        <x-shared.empty-box text="ningún colaborador asociado a esta planeación" />
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    @if (auth()->user()->isResponsibleOfPlanning($planning))
        <div class="row mb-3">
            <div class="col-12">
                <form id="planning-user-detach-form"
                    action="{{ route('plannings.users.detach', [$planning, auth()->user()]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <a x-on:click="onDetachUserFromPlanning()" class="text-danger" style="cursor: pointer">
                        <b>
                            <i class="fas fa-door-open"></i>
                            quiero dejar de formar parte de esta planeación
                        </b>
                    </a>
                </form>
            </div>
        </div>
    @endif


    <div class="row">
        <div class="col-12">
            <h3 class="text-black">Secuencias didácticas</h3>
        </div>
        @forelse ($planning->subject->units as $unit)
            <div class="col-12">
                <div class="kt-card mb-3">
                    <div class="card-body kt-border-left kt-border-secondary">
                        <div class="row">
                            <div class="col-12 col-md-9">
                                <label for="" class="text-muted">
                                    <small>Unidad</small> <br>
                                    <b>{{ $unit->name }}</b>
                                </label>
                            </div>
                            <div class="col-12 col-md-3">
                                <small>Horas totales</small> <br>
                                <b>{{ $planning->topicContents()->whereUnit($unit)->sum('theoretical_hours') }}</b>
                                <b></b>
                            </div>
                        </div>
                        <hr>

                        <button type="button" class="btn btn-info btn-sm px-2 shadow-sm" data-toggle="modal"
                            data-target="#seeTopicsOfUnit{{ $unit->id }}Modal">
                            <small><i class="fas fa-eye mr-1"></i></small>
                            ver temas
                        </button>
                        <a class="btn btn-info btn-sm px-2 shadow-sm" href="{{route('plannings.units.show',[$planning, $unit])}}">
                            <small><i class="fas fa-eye mr-1"></i></small>
                            ver detalles
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="seeTopicsOfUnit{{ $unit->id }}Modal" tabindex="-1"
                            role="dialog" aria-labelledby="seeTopicsOfUnit{{ $unit->id }}ModalTitle"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                            Temas y subtemas de la unidad
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="kt-table table-bordered">
                                                <tbody>
                                                    @foreach ($unit->topics as $topic)
                                                        <tr>
                                                            <td>
                                                                <a
                                                                    href="{{ route('plannings.topics.show', [$planning, $topic]) }}">
                                                                    {{ $topic->title }}
                                                                </a>
                                                            </td>
                                                            <td nowrap class="d-flex align-items-center">
                                                                @if ($topic->topicContents()->wherePlanning($planning)->whereNotNull('activity')->exists())
                                                                    <div data-toggle="tooltip"
                                                                        title="cuenta con descripción de actividad"
                                                                        class="d-inline-block mr-1"
                                                                        style="background: #c5ffc3; border: 3px solid #77c075; width:15px; height:15px; border-radius: 50%">
                                                                    </div> <span class="text-success">con
                                                                        actividad</span>
                                                                @else
                                                                    <div class="d-inline-block mr-1"
                                                                        data-toggle="tooltip"
                                                                        title="no cuenta con descripción de actividad"
                                                                        style="background: #ffc3c3; border: 3px solid #c07575; width:15px; height:15px; border-radius: 50%">
                                                                    </div> <span class="text-danger">sin
                                                                        actividad</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @foreach ($topic->subtopics as $subtopic)
                                                            <tr>
                                                                <td>
                                                                    <div class="ml-4">
                                                                        <span>
                                                                            <a
                                                                                href="{{ route('plannings.subtopics.show', [$planning, $subtopic]) }}">
                                                                                {{ $subtopic->title }}
                                                                            </a>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td nowrap class="">
                                                                    @if ($subtopic->subtopicContents()->wherePlanning($planning)->whereNotNull('activity')->exists())
                                                                        <div data-toggle="tooltip"
                                                                            title="cuenta con descripción de actividad"
                                                                            class="d-inline-block mr-1"
                                                                            style="background: #c5ffc3; border: 3px solid #77c075; width:15px; height:15px; border-radius: 50%">
                                                                        </div> <span class="text-success">con
                                                                            actividad</span>
                                                                    @else
                                                                        <div class="d-inline-block mr-1"
                                                                            data-toggle="tooltip"
                                                                            title="no cuenta con descripción de actividad"
                                                                            style="background: #ffc3c3; border: 3px solid #c07575; width:15px; height:15px; border-radius: 50%">
                                                                        </div> <span class="text-danger">sin
                                                                            actividad</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                                            <i class="fas fa-times"></i></button>
                                        <button type="button" class="btn btn-success btn-sm shadow">
                                            <i class="fas fa-save"></i>
                                            guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="kt-card">
                    <div class="card-body">
                        <x-shared.empty-box text="Esta asignatura no cuenta con ninguna unidad creada." />
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="row">
        <div class="col-12">
            <h3 class="text-black m-0">
                Activación de evaluaciones colegiadas del aprendizaje por asignatura
                @if (auth()->user()->isResponsibleOfPlanning($planning))
                    <button class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#ecaaModal">
                        <small><i class="fas fa-edit"></i></small>
                        modificar
                    </button>
                @endif
            </h3>

            @if (auth()->user()->isResponsibleOfPlanning($planning))
                <!-- Modal -->
                <div class="modal fade" id="ecaaModal" tabindex="-1" role="dialog" aria-labelledby="ecaaModalTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Activación de Evaluaciones Colegiadas
                                    del Aprendizaje por Asignatura</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('plannings.ecaas.store', [$planning]) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="text-muted">fechas</label>
                                            @foreach ($planning->ecaas as $ecaa)
                                                <input name="dates[]" type="date" class="form-control mb-1"
                                                    value="{{ $ecaa->date }}">
                                            @endforeach
                                            <input name="dates[]" type="date" class="form-control mb-1">
                                            <input name="dates[]" type="date" class="form-control mb-1">
                                            <input name="dates[]" type="date" class="form-control mb-1">
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-dismiss="modal">
                                                <small><i class="fas fa-times"></i></small>
                                            </button>
                                            <button class="btn btn-sm btn-success">
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

            <small class="mb-2" style="font-size: 15px">
                (<a target="_blank" href="https://ecaas.buap.mx/">
                    https://ecaas.buap.mx/
                </a>)
            </small>
        </div>
        <div class="col-12">
            <div class="kt-card">
                <div class="card-body kt-border-left kt-border-red">
                    @if ($planning->ecaas()->exists())
                        <div class="row">
                            @foreach ($planning->ecaas as $ecaa)
                                <div class="col-12 col-md-3">
                                    <small><label class="text-muted">fecha</label></small> <br>
                                    <b>{{ $ecaa->date }}</b>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <x-shared.empty-box text="Ningúna fecha propuesta." />
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function data($wire) {
            return {

                users: @json($allUsers),
                usersSelected: [],

                init() {},

                async onSelectUser(event, userToPush) {
                    event.stopPropagation()

                    userAlreadySelected = _.find(this.usersSelected, function(user) {
                        return user.id == userToPush.id
                    })

                    if (userAlreadySelected) {
                        return;
                    }

                    this.usersSelected.push(userToPush)
                },

                async onUnselectUser(userToRemove) {

                    this.usersSelected = _.filter(this.usersSelected, function(user) {
                        return user.id != userToRemove.id
                    })

                },

                async onSearchUser() {
                    const termToSearch = document.getElementById('identifier-search-input').value
                    const users = await this.$wire.usersWhereIdentifier(termToSearch)
                    this.users = new Proxy(JSON.parse(users), {})
                },

                onDetachUserFromPlanning() {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción no se podrá revertir.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, quiero salir',
                        cancelButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('planning-user-detach-form').submit()
                        }
                    })
                }
            }
        }

    </script>

</div>
