<div x-data="data()" wire:ignore>
    <x-shared.title title="Planeación didáctica de {{ $subject->title }}" />

    <div class="row mb-3">
        <div class="col-12">
            <label for="" class="text-muted">Código de la Asignatura: </label> {{ $subject->key }}
            <span class="float-right">
                <label for="" class="text-muted">Asignatura: </label> {{ $subject->title }}
            </span>
        </div>
        <div class="col-12">
            Fecha de Creación: {{ ucfirst(Carbon::now()->translatedFormat('F Y')) }}
        </div>
    </div>
    <form action="" method="POST">
        @csrf

        <div class="row mt-3">
            <div class="col-12">
                <div class="kt-card">
                    <div class="card-header">
                        Unidad de Aprendizaje
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <select class="form-control" id="subject_unit" name="subject_unit" required="required"
                                    x-on:change="">
                                    <template x-for="(subject_unit, index) in subject_units" :key="index">
                                        <option :id="index" x-text="subject_unit"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        Competencia (s) de la unidad de aprendizaje
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <textarea class="form-control" name="unit_competence"></textarea>
                        </div>
                    </div>
                    <div class="card-header">
                        PLANEACIÓN POR UNIDAD DE APRENDIZAJE
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted">Contenido Temático</label>
                                <textarea class="form-control" name="thematic_content"></textarea>
                                <small>Estipulado en el Programa de Asignatura.</small>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted">
                                    Estrategias de Aprendizaje sugeridas
                                </label>
                                <br/>
                                <table class="table table-hover table-sm">
                                    <tbody>
                                        <template x-for="(strategy, index) in subject_strategies" :key="index">
                                            <tr>
                                                <td style="width:10px">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" :id="'strategy' + index" name="strategies_ids[]" :value="index">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="form-check-label font-90" :for="'strategy' + index">
                                                        <span x-text="strategy"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted">
                                    Recursos didácticos y materiales sugeridos
                                </label>
                                <table class="table table-hover table-sm">
                                    <tbody>
                                        <template x-for="(resource, index) in subject_resources" :key="index">
                                            <tr>
                                                <td style="width:10px">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" :id="'resource' + index" name="resources_ids[]" :value="index">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="form-check-label font-90" :for="'resource' + index">
                                                        <span x-text="resource"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12">
                                <label for="" class="text-muted">Duración (horas)</label>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="number" class="form-control" name="hours_theorical_practical" placeholder="Teórico / Práctico" required="required"/>
                            </div>
                            <div class="col-6 mb-3">
                                <input type="number" class="form-control" name="hours_independent_work" placeholder="Trabajo Independiente" required="required"/>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="" class="text-muted">
                                    Evidencias de Aprendizaje
                                </label>
                                <table class="table table-hover table-sm">
                                    <tbody>
                                        <template x-for="(evidence_, index) in evidence" :key="index">
                                            <tr>
                                                <td style="width:10px">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" :id="'evidence_' + index" name="evidence_ids[]" :value="index">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="form-check-label font-90" :for="'evidence_' + index">
                                                        <span x-text="evidence_"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                        </template>
                                            <tr>
                                                <td style="width:10px">
                                                    
                                                </td>
                                                <td>
                                                    <label class="form-check-label font-90" for="evidence_other">
                                                        Otro (especificar)
                                                    </label>
                                                    <input type="text" class="form-control" id="evidence_other" name="evidence_other" required="required"/>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="text-muted">
                                    Instrumentos
                                </label>
                                <table class="table table-hover table-sm">
                                    <tbody>
                                        <template x-for="(instrument, index) in instruments" :key="index">
                                            <tr>
                                                <td style="width:10px">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" :id="'instrument' + index" name="instruments_ids[]" :value="index">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="form-check-label font-90" :for="'instrument' + index">
                                                        <span x-text="instrument"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                        </template>
                                            <tr>
                                                <td style="width:10px">
                                                    
                                                </td>
                                                <td>
                                                    <label class="form-check-label font-90" for="instrument_other">
                                                        Otro (especificar)
                                                    </label>
                                                    <input type="text" class="form-control" name="instrument_other" id="instrument_other" required="required"/>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="text-muted">Ponderación</label>
                                <input type="number" min="1" max="99" class="form-control input-weighting" name="weighting" required="required">
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <a href="{{ route('didactic-planning.show', [$subject]) }}" class="btn btn-secondary btn-sm shadow-sm">
                    <i class="fas fa-ban"></i> Cancelar
                </a>
                <button class="btn btn-success btn-sm shadow-sm">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </form>



    <script>
        function data() {
            return {
                subject_units: @json($subject->units->pluck('name', 'id')->toArray()),
                subject_strategies: @json($subject->strategies->pluck('description', 'id')->toArray()),
                subject_resources: @json($subject->resources->pluck('description', 'id')->toArray()),
                evidence: @json($evidence->pluck('description', 'id')->toArray()),
                instruments: @json($instruments->pluck('description', 'id')->toArray()),
                

                init() {
                    var cleave = new Cleave('.input-weighting', {
                        numericOnly: true,
                        blocks: [2],
                    });
                },
            }
        }

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

</div>
