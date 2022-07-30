<div>

    <x-navigator
        :routes="[ 'Planeación Didáctica de '.$unit->subjects()->first()->title =>  route('plannings.show', [$planning]) ]" />

    {{-- COMPETENCES --}}
    <div class="row mb-3">
        <div class="col-12">
            <h3 class="d-inline-block text-black">
                Competencias Profesionales sugeridas
            </h3>

            @if (auth()->user()->isResponsibleOfPlanning($planning))
                {{-- edit competences button --}}
                <a href="" class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#editCompetencesModalCenter">
                    <small><i class="fas fa-hand-pointer mr-1"></i></small>
                    Seleccionar
                </a>
                {{-- end edit competences button --}}

                {{-- select competences modal --}}
                <div class="modal fade" id="editCompetencesModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="editCompetencesModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCompetencesModalLongTitle">Competencias profesionales
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('plannings.units.competences.attach', [$planning, $unit]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">

                                        <div class="kt-table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach ($planning->subject->competences as $competence)
                                                        <tr>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="flexCheckChecked" name="competence_ids[]"
                                                                        value="{{ $competence->id }}"
                                                                        {{ $unitContent->hasCompetence($competence) ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="flexCheckChecked">
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{ $competence->description }}
                                                            </td>
                                                            <td>
                                                                {{ $competence->type }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-sm shadow-sm btn-success float-right mr-1">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger float-right mr-1"
                                            data-dismiss="modal">
                                            <i class="fas fa-times"></i> Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end edit competences modal --}}
            @endif

            <div class="row">
                <div class="col-12">
                    <x-competences.index :competences="$unitContent->competences" />
                </div>
            </div>
            {{-- end select competences modal --}}
        </div>
    </div>
    {{-- END COMPETENCES --}}

    {{-- STRATEGIES --}}
    <div class="mb-4">
        <div class="row">
            <div class="col-12">
                <h3 class="text-black d-inline-block">Estrategias y Técnicas Didácticas</h3>

                @if (auth()->user()->isResponsibleOfPlanning($planning))
                    {{-- select transversal axis button --}}
                    <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                        data-target="#selectStrategiesModal">
                        <i class="fas fa-plus"></i> Seleccionar
                    </button>
                    {{-- end select transversal axis modal --}}


                    {{-- select transversal axis button --}}
                    <div class="modal fade" id="selectStrategiesModal" tabindex="-1" role="dialog"
                        aria-labelledby="selectStrategiesModal" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Seleccionar Estrategias y Técnicas didácticas
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="{{ route('plannings.units.strategies.attach', [$planning, $unit]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="kt-table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach ($strategies->pluck('description')->toArray() as $strategyDescription)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="strategy_descriptions[]"
                                                                    value="{{ $strategyDescription }}"
                                                                    {{ $unitContent->hasStrategy($strategyDescription) ? 'checked' : '' }}>
                                                            </td>
                                                            <td>{{ $strategyDescription }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-sm shadow-sm float-right">
                                            <i class="fas fa-save"></i> Guardar
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
                    {{-- end select transversal axis button --}}

                @endif

            </div>
        </div>

        <x-strategies.index :strategies="$unitContent->strategies" />

    </div>
    {{-- END STRATEGIES --}}

    {{-- RESOURCES --}}
    <div class="mb-4">
        <div class="row">
            <div class="col-12">
                <h3 class="text-black d-inline-block">
                    Recursos Didácticos y materiales didácticos
                </h3>

                @if (auth()->user()->isResponsibleOfPlanning($planning))
                    {{-- select transversal axis button --}}
                    <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                        data-target="#didacticResourcesModal">
                        <i class="fas fa-plus"></i> Seleccionar
                    </button>
                    {{-- end select transversal axis modal --}}

                    {{-- select transversal axis button --}}
                    <div class="modal fade" id="didacticResourcesModal" tabindex="-1" role="dialog"
                        aria-labelledby="didacticResourcesModal" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Seleccionar Recursos Didácticos
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('plannings.units.resources.attach', [$planning, $unit]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="kt-table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach ($resources->pluck('description')->toArray() as $resourceDescription)
                                                        <tr>
                                                            <td><input type="checkbox" name="resource_descriptions[]"
                                                                    value="{{ $resourceDescription }}"
                                                                    {{ $unitContent->hasResource($resourceDescription) ? 'checked' : '' }}>
                                                            </td>
                                                            <td>{{ $resourceDescription }}</td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-sm shadow-sm float-right">
                                            <i class="fas fa-save"></i> Guardar
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
                @endif
                {{-- end select transversal axis button --}}
            </div>
        </div>

        {{-- subject's resources list --}}
        <x-resources.index :resources="$unitContent->resources" />
    </div>
    {{-- END RESOURCES --}}

    {{-- EVIDENCES --}}
    <div class="mb-4">
        <div class="row">
            <div class="col-12">
                <h3 class="text-black d-inline-block">Evidencias de Aprendizaje</h3>
                {{-- select transversal axis button --}}

                @if (auth()->user()->isResponsibleOfPlanning($planning))
                    <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                        data-target="#selectEvidenceModal">
                        <i class="fas fa-plus"></i> Seleccionar
                    </button>
                    {{-- end select transversal axis modal --}}
                    {{-- select transversal axis button --}}
                    <div class="modal fade" id="selectEvidenceModal" tabindex="-1" role="dialog"
                        aria-labelledby="selectEvidenceModal" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Seleccionar Evidencias de Aprendizaje
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="{{ route('plannings.units.evidences.attach', [$planning, $unit]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="kt-table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach (evidences() as $evidenceDescription)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="evidence_descriptions[]"
                                                                    value="{{ $evidenceDescription }}"
                                                                    {{ $unitContent->hasEvidence($evidenceDescription) ? 'checked' : '' }}>
                                                            </td>
                                                            <td>{{ $evidenceDescription }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            otro (especificar)
                                                            <input type="text" name="evidence_descriptions[]"
                                                                class="form-control"
                                                                value="{{ $unitContent->extra_evidence ? $unitContent->extra_evidence->description : '' }}">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-sm shadow-sm float-right">
                                            <i class="fas fa-save"></i> Guardar
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
                    {{-- end select transversal axis button --}}
                @endif
            </div>
        </div>

        <x-evidences.index :evidences="$unitContent->evidences" />

    </div>
    {{-- END EVIDENCES --}}

    {{-- INSTRUMENTS --}}
    <div class="mb-4">
        <div class="row">
            <div class="col-12">
                <h3 class="text-black d-inline-block">Instrumentos de evaluación</h3>

                @if (auth()->user()->isResponsibleOfPlanning($planning))

                    {{-- select transversal axis button --}}
                    <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                        data-target="#selectInstrumentModal">
                        <i class="fas fa-plus"></i> Seleccionar
                    </button>
                    {{-- end select transversal axis modal --}}

                    {{-- select transversal axis button --}}
                    <div class="modal fade" id="selectInstrumentModal" tabindex="-1" role="dialog"
                        aria-labelledby="selectInstrumentModal" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Seleccionar Instrumentos de evaluación
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="{{ route('plannings.units.instruments.attach', [$planning, $unit]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="kt-table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach (instruments() as $instrumentDescription)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="instrument_descriptions[]"
                                                                    value="{{ $instrumentDescription }}"
                                                                    {{ $unitContent->hasInstrument($instrumentDescription) ? 'checked' : '' }}>
                                                            </td>
                                                            <td>{{ $instrumentDescription }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            otro (especificar)
                                                            <input type="text" name="instrument_descriptions[]"
                                                                class="form-control"
                                                                value="{{ $unitContent->extra_instrument ? $unitContent->extra_instrument->description : '' }}">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-sm shadow-sm float-right">
                                            <i class="fas fa-save"></i> Guardar
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
                    {{-- end select transversal axis button --}}
                @endif

            </div>
        </div>

        {{-- subject's strategies list --}}
        <x-instruments.index :instruments="$unitContent->instruments" />

    </div>
    {{-- END INSTRUMENTS --}}

        {{-- WEIGHING --}}
        <div class="row mb-3">
            <div class="col-12 col-md-6">
    
                <h3 class="d-inline-block text-black">
                    Ponderación
                </h3>
    
                @if (auth()->user()->isResponsibleOfPlanning($planning))
                    <a href="" class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                        data-target="#editUnitWeighingModalCenter">
                        <small><i class="fas fa-scroll mr-1"></i></small>
                        Definir
                    </a>
    
                    <!-- Modal -->
                    <div class="modal fade" id="editUnitWeighingModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="editUnitWeighingModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-xs modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form
                                        action="{{ route('plannings.units.weighing.update', [$planning, $unit]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="" class="text-muted">
                                                Definir la ponderación
                                            </label>
                                            <input type="number" class="form-control" step="0.01" name="unit_weighing"
                                                min="0" max="10" value="{{ $unitContent->weighing }}">
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-sm shadow-sm btn-success float-right mr-1">
                                                <i class="fas fa-save"></i> Guardar
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger float-right mr-1"
                                                data-dismiss="modal">
                                                <i class="fas fa-times"></i> Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
    
                <div class="kt-card">
                    <div class="card-body">
                        {{ $unitContent->weighing }}
                    </div>
                </div>
            </div>
        </div>
        {{-- END WEIGHING --}}

</div>
