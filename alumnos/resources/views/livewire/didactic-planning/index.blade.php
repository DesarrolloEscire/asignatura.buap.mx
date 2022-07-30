<div>

    <x-shared.title title="Planeación didáctica" />

    <div class="row">
        <div class="col-12 col-md-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text border-0 shadow-sm" id="basic-addon1">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input type="text" class="form-control border-0 shadow-sm" placeholder="Buscar asignatura"
                    wire:model="searchTerm" aria-label="Buscar asignatura" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($subjects as $subject)
            <div class="col-12 col-md-6">
                <div class="kt-card mb-3">
                    <div class="card-body kt-border-left kt-border-secondary">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="text-muted">
                                    <small>ASIGNATURA</small> <br>
                                    <b>{{ $subject->title }}</b>
                                </label>
                            </div>
                            <div class="col-12 col-md-4">
                                <small>CÓDIGO</small> <br>
                                <b>{{ $subject->key }}</b>
                            </div>
                            <div class="col-12 col-md-8">
                                <small>UNIDAD ACADÉMICA</small> <br>
                                <b>Facultad de ...</b>
                            </div>
                        </div>
                        <hr>
                        <div class="d-inline-block">
                            <a target="_blank" href="{{ route('subjects.pdf', [$subject]) }}"
                                class="btn btn-primary btn-sm px-2 shadow-sm">
                                <i class="fas fa-solid fa-digital-tachograph"></i>
                                Programa educativo
                            </a>
                            <a href="{{ route('subject.plannings.show', [$subject]) }}"
                                class="btn btn-primary btn-sm px-2 shadow-sm">
                                <i class="fas fa-solid fa-file-invoice"></i>
                                Planeación didáctica
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
