<div>

    <x-shared.title title="Asignatura de: <b class='text-info'><i>{{ $subject->title }}</i></b>" />

    <x-subjects.submenu :subject="$subject" activeSection="general-information" />


    <div class="mb-4">
        <div class="row">
            <div class="col-12">
                <h3 class="text-black d-inline-block">Estrategias y técnicas didácticas</h3>

                @if ($subject->is_updateable)
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
                                        Seleccionar estrategias y técnicas didácticas
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('subjects.strategies.store', [$subject]) }}" method="POST">
                                        @csrf
                                        <div class="kt-table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach (strategies() as $strategyDescription)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="strategy_descriptions[]"
                                                                    value="{{ $strategyDescription }}"
                                                                    {{ $subject->hasStrategy($strategyDescription) ? 'checked' : '' }}>
                                                            </td>
                                                            <td>{{ $strategyDescription }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            Otro (especificar)
                                                            <input type="text" name="strategy_descriptions[]"
                                                                class="form-control" maxlength="190"
                                                                value="{{ $subject->extra_strategy ? $subject->extra_strategy->description : '' }}">
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
                                            <i class="fas fa-times"></i> Cancelar
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
        @if ($subject->strategies()->count())
            <div class="row">
                @foreach ($subject->strategies as $strategy)
                    <div class="col-12 mb-3">
                        <div class="kt-card">
                            <div class="card-body kt-border-left kt-border-secondary">
                                {{ $strategy->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="kt-card">
                <div class="card-body">
                    <x-shared.empty-box text="Ninguna estrategia o técnica seleccionada" />
                </div>
            </div>
        @endif

    </div>

    <div class="mb-4">
        <div class="row">
            <div class="col-12">
                <h3 class="text-black d-inline-block">Recursos didácticos</h3>

                @if ($subject->is_updateable)
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
                                        Seleccionar recursos didácticos
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('subjects.resources.store', [$subject]) }}" method="POST">
                                        @csrf
                                        <div class="kt-table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach (resources() as $resourceDescription)
                                                        <tr>
                                                            <td><input type="checkbox" name="resource_descriptions[]"
                                                                    value="{{ $resourceDescription }}"
                                                                    {{ $subject->hasResource($resourceDescription) ? 'checked' : '' }}>
                                                            </td>
                                                            <td>{{ $resourceDescription }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            Otro (especificar)
                                                            <input type="text" name="resource_descriptions[]"
                                                                class="form-control" maxlength="190"
                                                                value="{{ $subject->extra_resource ? $subject->extra_resource->description : '' }}">
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
                                            <i class="fas fa-times"></i> Cancelar
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

        {{-- subject's resources list --}}
        @if ($subject->resources()->count())
            <div class="row">
                @foreach ($subject->resources as $resource)
                    <div class="col-12 mb-3">
                        <div class="kt-card">
                            <div class="card-body kt-border-left kt-border-secondary">
                                {{ $resource->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="kt-card">
                <div class="card-body">
                    <x-shared.empty-box text="Ningún recurso didáctico seleccionado" />
                </div>
            </div>
        @endif
    </div>

    @if (!$subject->is_fgu)
        <div class="mb-4">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-black d-inline-block">Ejes transversales</h3>

                    @if ($subject->is_updateable)
                        {{-- select transversal axis button --}}
                        <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                            data-target="#selectTransversalAxisModal">
                            <i class="fas fa-plus"></i> Seleccionar
                        </button>
                        {{-- end select transversal axis modal --}}


                        {{-- select transversal axis modal --}}
                        <div class="modal fade" id="selectTransversalAxisModal" tabindex="-1" role="dialog"
                            aria-labelledby="selectTransversalAxisModal" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Seleccionar ejes transversales
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('subjects.axes.store', [$subject]) }}" method="POST">
                                            @csrf
                                            <div class="kt-table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        @foreach (axes() as $axisDescription)
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" name="axis_descriptions[]"
                                                                        value="{{ $axisDescription }}"
                                                                        {{ $subject->hasAxis($axisDescription) ? 'checked' : '' }}>
                                                                </td>
                                                                <td>{{ $axisDescription }}</td>
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
                                                <i class="fas fa-times"></i> Cancelar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end select transversal axis modal --}}
                    @endif
                </div>
            </div>

            {{-- subject's axes list --}}
            @if ($subject->axes()->count())
                <div class="row">
                    @foreach ($subject->axes as $axis)
                        <div class="col-12 mb-3">
                            <div class="kt-card">
                                <div class="card-body kt-border-left kt-border-secondary">
                                    {{ $axis->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="kt-card">
                    <div class="card-body">
                        <x-shared.empty-box text="Ningún eje transversal seleccionado" />
                    </div>
                </div>
            @endif

        </div>
    @endif


    <div class="mb-4">
        <div class="row">
            <div class="col-12">
                <h3 class="text-black d-inline-block">Criterios de evaluación</h3>

                @if ($subject->is_updateable)
                    {{-- select criterion button --}}
                    <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                        data-target="#selectEvaluationCriteriaModal">
                        <i class="fas fa-plus"></i> Seleccionar
                    </button>
                    {{-- end select criterion modal --}}

                    {{-- select criterion button --}}
                    <div class="modal fade" id="selectEvaluationCriteriaModal" tabindex="-1" role="dialog"
                        aria-labelledby="selectEvaluationCriteriaModal" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Seleccionar criterios de evaluación
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('subjects.criteria.store', [$subject]) }}" method="POST">
                                        @csrf
                                        <div class="kt-table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach (criteria() as $position => $criterionDescription)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox"
                                                                    name="criteria[{{ $position }}][description]"
                                                                    value="{{ $criterionDescription }}"
                                                                    {{ $subject->hasCriterion($criterionDescription) ? 'checked' : '' }}>
                                                            </td>
                                                            <td>{{ $criterionDescription }}</td>
                                                            <td style="width: 100px">
                                                                <div class="input-group input-group-sm mb-3">
                                                                    <input type="number" class="form-control"
                                                                        placeholder="0.00" aria-label="porcentaje"
                                                                        name="criteria[{{ $position }}][percentage]"
                                                                        step="0.01"
                                                                        value="{{ !$subject->hasCriterion($criterionDescription) ? '' : $subject->criteria()->whereDescription($criterionDescription)->first()->pivot->percentage }}">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">%</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            Otro (especificar)
                                                            <input type="text"
                                                                name="criteria[{{ count(criteria()) }}][description]"
                                                                class="form-control" maxlength="190"
                                                                value="{{ $subject->extra_criterion ? $subject->extra_criterion->description : '' }}">
                                                        </td>
                                                        <td style="width: 150px">
                                                            <div class="input-group input-group-sm mb-3">
                                                                <input type="number" class="form-control"
                                                                    placeholder="0.00"
                                                                    name="criteria[{{ count(criteria()) }}][percentage]"
                                                                    aria-label="porcentaje" step="0.01"
                                                                    value="{{ !$subject->extra_criterion ? '' : $subject->extra_criterion->pivot->percentage }}">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
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
                                            <i class="fas fa-times"></i> Cancelar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end select criterion button --}}

                @endif

            </div>
        </div>

        {{-- subject's criteria list --}}
        @if ($subject->criteria()->count())
            <div class="row">
                @foreach ($subject->criteria as $criterion)
                    <div class="col-12 mb-3">
                        <div class="kt-card">
                            <div class="card-body kt-border-left kt-border-secondary">
                                {{ $criterion->description }}
                                <span class="float-right"><b>{{ $criterion->pivot->percentage }}</b> %</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="kt-card">
                <div class="card-body">
                    <x-shared.empty-box text="Ningún criterio de evaluación seleccionado" />
                </div>
            </div>
        @endif

    </div>

</div>
