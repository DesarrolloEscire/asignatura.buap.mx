<div>

    <div class="row">
        <div class="col-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                crear competencia específica
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('educational-programs.competences.store',[$educationalProgram])}}" method="POST">
                                @csrf
                                <textarea name="competence_description" class="form-control"></textarea>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($educationalProgram->competences as $competence)
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        {{ $competence->description }}
                        <a href="{{ route('competences.competence-units.index', [$competence]) }}">unidades de
                            competencia</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
