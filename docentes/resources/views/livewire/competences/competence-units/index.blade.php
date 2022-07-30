<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{ $competence->description }}
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModalCenter{{ $competence->id }}">
        añadir unidad de competencia
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter{{ $competence->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenter{{ $competence->id }}Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        {{ $competence->description }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('competences.competence-units.store', [$competence]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">descripcion</label> <br>
                                <textarea name="competence_unit_description" class="form-control" cols="30" rows="10"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            UNIDADES DE COMPETENCIA
            <hr>
            @foreach ($competenceUnits as $competenceUnit)
                <div class="border mb-3">
                    {{ $competenceUnit->description }}
                </div>

                <!-- Button trigger modal -->

                <form action="{{ route('competence-units.delete',[$competenceUnit]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">eliminar</button>
                </form>

                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#editCompetenceUnit{{ $competenceUnit->id }}">
                    editar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="editCompetenceUnit{{ $competenceUnit->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editCompetenceUnit{{ $competenceUnit->id }}Title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('competences.competence-units.update', [$competenceUnit]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <textarea name="competence_unit_description" id="" cols="30"
                                                rows="10">{{ $competenceUnit->description }}</textarea>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
