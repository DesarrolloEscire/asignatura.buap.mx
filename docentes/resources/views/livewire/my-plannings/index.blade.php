<div x-data="data()">

    <x-shared.title title="Mis planeaciones didácticas"
        subtitle="En esta sección podrás visualizar y modificar tus planeaciones didácticas" />

    <div class="row">
        <div class="col-12">
            <h3 class="d-inline-block text-black">
                <div class="col-12">
                    Mis Planeaciones Didácticas
                </div>
            </h3>
            <a href="{{ route('plannings.index') }}" class="text-info float-right" style="font-size: 20px">
                <b>
                    <i class="fas fa-lightbulb"></i>
                    buscar asignatura para crear mi planeación
                </b>
            </a>
        </div>
        @forelse ($plannings as $planning)
            <div class="col-12 mb-2">
                <div class="kt-card">
                    <div class="card-body kt-border-left kt-border-secondary">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <label for="" class="text-muted">Asignatura</label><br>
                                <b>{{ $planning->subject->title }}</b>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="" class="text-muted">Clave de asignatura</label><br>
                                <b>{{ $planning->subject->key }}</b>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="" class="text-muted">Fecha de creación</label><br>
                                <b>{{ $planning->created_at }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <a href="{{ route('plannings.show', [$planning]) }}"
                                    class="btn btn-primary btn-sm shadow-sm">
                                    <small><i class="fas fa-eye"></i></small>
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
                                        <form action="{{ route('plannings.unpublish', [$planning]) }}" method="POST"
                                            class="d-inline float-right mr-2">
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
        @empty
            <div class="col-12 mb-2">
                <div class="col-12">
                    <div class="kt-card">
                        <div class="card-body">
                            <x-shared.empty-box
                                text="Ninguna planeación didáctica creada. dale <a href='{{ route('plannings.index') }}'>click aquí</a> para búscar una asignatura y crear tu planeación didáctica." />
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <script>
        function data() {
            return {
                init() {
                    Swal.fire(
                        'Planeación didáctica',
                        'La planeación didáctica es un plan de trabajo que contemple los elementos que intervendrán en el proceso de enseñanza-aprendizaje organizados para facilitar los contenidos en el tiempo disponible para un curso dentro de un plan de estudios.'
                    )
                }
            }
        }
    </script>

</div>
