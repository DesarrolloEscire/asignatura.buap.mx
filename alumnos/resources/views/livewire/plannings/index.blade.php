<div>

    <x-shared.title title="Busca tu programa de asignatura para diseñar tu Planeación Didáctica." subtitle='Si no encuentras tu programa de asignatura, dirígete a tu Secretaría Académica para que notifique al responsable que capture el contenido en la sección de "Mis asignaturas". El responsable de asignatura es asignado por el(la) Secretario(a) Académico(a).' />

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

    <style>
        .kt-border-secondary {
            border-color: #FF7F00;
        }

    </style>

    <div class="row">
        @forelse ($subjects as $subject)
            <div class="col-12">
                <x-subjects.details :subject="$subject">

                    <div class="d-inline-block">
                        <a href="{{ route('subjects.plannings.index', [$subject]) }}"
                            class="btn btn-primary btn-sm px-2 shadow-sm">
                            <i class="fas fa-solid fa-file-invoice"></i>
                            ver planeaciones
                        </a>
                    </div>
                    <div class="d-inline-block float-right mr-1" wire:ignore.self>
                        <form action="{{ route('subjects.plannings.store', [$subject]) }}" method="POST">
                            @csrf
                            <button class="btn btn-info btn-sm px-2 shadow-sm">
                                <i class="fas fa-plus"></i> crear planeación didáctica
                            </button>
                        </form>
                    </div>

                </x-subjects.details>

            </div>
        @empty
        <div class="col-12">
            <div class="kt-card">
                <div class="card-body">
                    <x-shared.empty-box text="Ninguna planeación didáctica por mostrar" subtext="utiliza el buscador que se encuentra en la parte superior izquierda para colocar el código o nombre de la asignatura que deseas encontrar." />
                </div>
            </div>
        </div>
        @endforelse

        @if (!$subjects->isEmpty())
            {{ $subjects->links() }}
        @endif
    </div>
</div>
