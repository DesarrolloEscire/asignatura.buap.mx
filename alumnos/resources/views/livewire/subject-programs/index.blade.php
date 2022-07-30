<div>
    <div class="row">
        @foreach ($educationalPrograms as $educationalProgram)
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="">CLAVE</label> <br>
                            <a href="{{route('subject-programs.show',[$educationalProgram])}}" class="text-info">{{$educationalProgram->key}}</a>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="">UNIDADES ACADÉMICAS<br>
                            @foreach ($educationalProgram->academicUnits as $academicUnit)
                                {{$academicUnit->name}} ({{$academicUnit->key}})
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
