<div wire:ignore.self id="modalApproveSubject{{ $dynamic ? $subject->id : '' }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">¿Aprobar asignatura?</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('subjects.approve',[$subject])}}" method="POST">
                @csrf
                <div class="modal-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="formulario-tab" data-toggle="tab" href="#formulario" role="tab" aria-controls="formulario" aria-selected="true">Formulario</a>
                            <a class="nav-item nav-link" id="historico-tab" data-toggle="tab" href="#historico" role="tab" aria-controls="historico" aria-selected="false">Histórico</a>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="formulario" role="tabpanel" aria-labelledby="formulario-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="control-label">ESTATUS</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="is_approved" type="radio" id="aprobada" value="true" required>
                                                        <label class="form-check-label" for="aprobada"><span class="badge badge-success">APROBADA</span></label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="is_approved" type="radio" id="noaprobada" value="false">
                                                        <label class="form-check-label" for="noaprobada"><span class="badge badge-danger">NO APROBADA</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="description" class="control-label">COMENTARIO</label>
                                                <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 text-right">
                                            <button class="btn btn-success btn-shadow rounded-0">
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="historico" role="tabpanel" aria-labelledby="historico-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Histórico de observaciones ({{ $subject->subjectObservations()->count() }})</h5>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Estatus</th>
                                                    <th>Comentario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($subject->subjectObservations()->get() as $subjectObservation)
                                                <tr>
                                                    <td>{{date_format($subjectObservation->created_at,'d/m/Y H:i:s')}}</td>
                                                    <td>{{ $subjectObservation->is_approved==TRUE ? 'Aprobada' : 'No aprobada' }}</td>
                                                    <td>{{ $subjectObservation->description }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td class="text-center" colspan="3">No hay observaciones registradas</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-shadow rounded-0" data-dismiss="modal">
                        <i class="fas fa-window-close"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>