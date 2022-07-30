<div>

    <x-shared.title title="Planeaciones didácticas de {{ $subject->title }}" />

    <div class="row mb-2">
        <div class="col-12">
            <small><i class="fas fa-globe"></i></small>
            <a href="{{ route('plannings.index') }}" class="text-primary">
                Lista de Asignaturas
            </a>
            /
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="kt-card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label for="" class="text-muted">
                                Clave de la Asignatura
                            </label> <br>
                            <b>{{ $subject->key }}</b>
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="" class="text-muted">
                                Asignatura
                            </label> <br>
                            <b>{{ $subject->title }}</b>
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="" class="text-muted">
                                Unidad Académica
                            </label> <br>
                            <b>
                                @if ($subject->academicUnits()->exists())
                                    @foreach ($subject->academicUnits as $academicUnit)
                                        {{ $academicUnit->name }}
                                    @endforeach
                                @else
                                    Formación general universitaria
                                @endif
                            </b>
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="" class="text-muted">
                                Programa de asignatura
                            </label> <br>
                            @if ($subject->educationalPrograms()->exists())
                                @foreach ($subject->educationalPrograms as $educationalProgram)
                                    <b>{{ $educationalProgram->name }}</b>
                                @endforeach
                            @else
                                <b>N/A</b>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <h3 class="d-inline-block text-black">
                <div class="col-12">
                    Planeaciones didácticas
                </div>
            </h3>
            <form action="{{ route('subjects.plannings.store', [$subject]) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-info btn-sm shadow-sm float-right">
                    <i class="fas fa-plus"></i> crear planeación didáctica
                </button>
            </form>
        </div>
        @forelse ($subject->plannings as $planning)

            @if ($planning->users()->whereUser(auth()->user())->exists() ||
    $planning->is_published)
                <div class="col-12">
                    <div class="kt-card mb-3">
                        <div class="card-body kt-border-left kt-border-secondary">
                            @forelse ($planning->users as $user)
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label for="" class="text-muted">
                                            <small>Autor</small> <br>
                                            <b>{{ strtoupper($user->name) }}</b>
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="" class="text-muted">
                                            <small>ID</small> <br>
                                            <b>{{ $user->identifier }}</b>
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="" class="text-muted">
                                            <small>email</small> <br>
                                            <b>{{ $user->email }}</b>
                                        </label>
                                    </div>
                                </div>
                                <hr class="mb-2 mt-0">
                            @empty
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <label for="" class="text-muted">
                                            <b>Sin autores asignados</b>
                                        </label>
                                    </div>
                                </div>
                                <hr class="mb-2 mt-0">

                            @endforelse
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('plannings.show', [$planning]) }}"
                                        class="btn btn-primary btn-sm shadow-sm">
                                        <small><i class="fas fa-eye"> </i></small>
                                        ver detalles
                                    </a>
                                    <a target="_blank" href="{{ route('plannings.pdf', [$planning]) }}"
                                        class="btn btn-danger btn-sm shadow-sm">
                                        <small><i class="fas fa-file-pdf"></i></small>
                                        ver pdf
                                    </a>
                                    @if (auth()->user()->isResponsibleOfPlanning($planning))
                                        <form action="{{ route('plannings.delete', [$planning]) }}" method="POST"
                                            class="d-inline float-right">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm shadow-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i> eliminar
                                            </button>
                                        </form>
                                        @if ($planning->is_published)
                                            <form action="{{ route('plannings.unpublish', [$planning]) }}"
                                                method="POST" class="d-inline float-right mr-2">
                                                @csrf
                                                <button class="btn btn-sm shadow-sm btn-outline-warning">
                                                    <i class="fas fa-eye"></i> despublicar
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @empty
                <div class="col-12">
                    <div class="kt-card">
                        <div class="card-body">
                            <x-shared.empty-box text="Ninguna planeación didáctica" />
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
