<div>

    <x-shared.title title="Planeación didáctica de {{ $subject->title }}" />

    <x-commons.backbutton>
        @slot('message','Lista de planeaciones didácticas')
        @slot('redirect','/planeaciones-didacticas')
    </x-commons.backbutton>

    @if($subject->units->count() > 0)
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('didactic-plannings.pdf', [$subject]) }}"
                class="btn btn-danger rounded-0 btn-sm shadow-sm float-right">
                <i class="fas fa-file-pdf mr-1"></i> Exportar
            </a>
        </div>
    </div>
    @endif
    <div class="row">
        @forelse ($subject->units as $unit)
            <div class="col-12">
                <div class="kt-card mb-3">
                    <div class="card-body kt-border-left kt-border-secondary">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="text-muted">
                                    <small>UNIDAD</small> <br>
                                    <b>{{ $unit->name }}</b>
                                </label>
                            </div>
                        </div>
                        <hr>
                        <a href="{{ route('topics.show', [$unit->topics()->first()]) }}" class="btn btn-info btn-sm px-2 shadow-sm">
                            <small><i class="fas fa-eye mr-1"></i></small>
                            ver secuencia didáctica
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="kt-card">
                    <div class="card-body">
                        <x-shared.empty-box text="Esta asignatura no cuenta con ninguna unidad creada."/>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

</div>
