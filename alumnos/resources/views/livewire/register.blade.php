<div class="card-body" x-data="data($wire)" x-init="init()" wire:ignore>
    <form id="registerUserForm" action="{{ route('register.store') }}" method="POST">
        @csrf
        <div class="text-center h5 modal-title">
            <h4 class="mt-2">

                <div class="d-flex justify-content-center">
                    <!-- <img src="{{ url('images/logo.png?20220531') }}" width="120px" class="img-fluid" alt=""> -->
                </div>

                <x-shared.auth-title title="Registrate" subtitle="Solo coloca tu ID en el siguiente campo">
                    </x-shared>

                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
            </h4>
        </div>
        <div class="form-row">
            <div class="col-md-12">
                <div class="position-relative form-group">
                    <input type="text" id="identifier" name="identifier" class="form-control"
                        placeholder="Identificador" required autofocus
                        x-on:keyup="onSearchStudent($event.target.value)">
                </div>
            </div>
        </div>
        <div class="form-row mb-1">
            <div class="col-md-12">
                <a href="javascript:void(0)" class="text-info" x-on:click="showRequestUserForm = !showRequestUserForm">
                    ¿No se encuentra tu identificador? Solicita tu usuario.
                </a>
            </div>
        </div>
        <template x-if="showRequestUserForm">
            <form action="{{ route('request-account') }}" id="requestUserForm" method="POST">
                @csrf
                <div class="card mb-1">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted text-uppercase">Identificador</label>
                                <input :value="student.identifier" name="identifier" type="text" class="form-control"
                                    placeholder="Tu id de docente" required maxlength="190" />
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted text-uppercase">Nombre</label>
                                <input :value="student.name" name="name" type="text" class="form-control"
                                    placeholder="Tu nombre completo" required maxlength="190" />
                            </div>
                            <div class="col-12">
                                <label for="" class="text-muted text-uppercase">Correo electrónico</label>
                                <div class="input-group mb-3">
                                    <input :value="student.email" name="email" pattern="^[^@]+$" type="text"
                                        class="form-control" placeholder="Correo" aria-label="correo" required
                                        maxlength="170">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">@alumno.buap.mx</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="" class="text-muted text-uppercase">
                                    Unidad Académica
                                </label>
                                <select name="academic_unit_id" id="" class="form-control" required>
                                    <option value="" hidden>Seleccionar</option>
                                    @foreach ($remoteAcademicUnits as $academicUnit)
                                        <option value="{{ $academicUnit->id }}">{{ $academicUnit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <template x-if="!studentExists">
                                <div class="col-12 clearfix modal-footer">
                                    <br>
                                    <hr>
                                    <button class="btn btn-success btn-sm btn-shadow float-right"
                                        form="requestUserForm">
                                        Solicitar registro
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </form>
        </template>
        <div class="form-row">
            <div class="col-12">
                <div class="text-info p-2 rounded" style="background: #bae6ff">
                    <i class="fas fa-info-circle"></i>
                    Posterior a tu registro, recibirás un correo electrónico en el que
                    deberás verificar
                    tu cuenta para poder iniciar sesión.
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <h6 class="mb-0">
            <a href="{{ route('login') }}" class="auth-form-link">Iniciar sesión con una cuenta existente</a>
        </h6>
        <template x-if="studentExists">
            <div class="clearfix modal-footer">
                <div class="float-right">
                    <button class="btn btn-primary btn-lg">Registrarme</button>
                </div>
            </div>
        </template>
    </form>

    <script>
        function data() {
            return {
                student: {
                    identifier: null,
                    name: null,
                    email: null
                },
                showRequestUserForm: false,
                studentExists: false,

                init() {},

                async onSearchStudent(identifier) {
                    var response = await this.$wire.searchStudent(identifier);

                    if (response != null) {
                        this.student = JSON.parse(response);
                        this.showRequestUserForm = true;
                        this.studentExists = true;
                        return
                    }

                    this.student = {
                        identifier: null,
                        name: null,
                        email: null
                    };

                    this.showRequestUserForm = false;
                    this.studentExists = false;

                }
            }
        }

    </script>
</div>
