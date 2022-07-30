    <div class="kt-card mb-3">
        <div class="card-body kt-border-left kt-border-secondary">
            <div class="row">
                <div class="col-12 col-md-6 mb-2">
                    <label for="" class="text-muted">
                        <small>ASIGNATURA</small> <br>
                        <b>{{ $subject->title }}</b>
                    </label>
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <small>CÓDIGO</small> <br>
                    <b>{{ $subject->key }}</b>
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <small>PLAN DE ESTUDIOS</small> <br>
                    @if ($subject->educationalPrograms()->exists())
                        @foreach ($subject->educationalPrograms as $educationalProgram)
                            <b>
                                {{ $educationalProgram->name }} ({{ $educationalProgram->key }})
                            </b> <br>
                        @endforeach
                    @else
                        <b>Formación General Universitaria</b>
                    @endif
                </div>
                @if ($subject->academicUnits()->exists())
                    <div class="col-12 col-md-6 mb-2">
                        <small>UNIDAD(ES) ACADÉMICA(S)</small> <br>
                        @foreach ($subject->academicUnits as $academicUnit)
                            <b>{{ $academicUnit->name }}</b> <br>
                        @endforeach
                    </div>
                @endif

                <div class="col-12 col-md-6 mb-2">
                    <small>HORAS TOTALES</small> <br>
                    <b>{{ $subject->hours }}</b>
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <small>CRÉDITOS</small> <br>
                    <b>{{ $subject->credits }}</b>
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <small>NIVEL</small> <br>
                    <b>{{ $subject->level ?? 'N/A' }}</b>
                </div>
                @if ($subject->educationalPrograms()->exists())
                    <div class="col-12 col-md-6 mb-2">
                        <small>MODALIDAD</small> <br>
                        <b>{{ $subject->educationalPrograms()->first()->modality ?? 'N/A' }}</b>
                    </div>
                @endif
            </div>
            <hr>
            {{ $slot }}
        </div>
    </div>
