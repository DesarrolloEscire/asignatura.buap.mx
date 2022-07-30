<div wire:ignore.self id="modalSubjectObservatios_{{$subject->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Histórico de observaciones: <strong>{{ $subject->title }}</strong></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5>Observaciones ({{ $subject->subjectObservations()->count() }})</h5>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-shadow rounded-0" data-dismiss="modal">
                    <i class="fas fa-window-close"></i>
                </button>
            </div>
        </div>
    </div>
</div>