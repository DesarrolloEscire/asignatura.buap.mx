<div>

    <x-shared.title title="Asignatura de: <b class='text-info'><i>{{ $subject->title }}</i></b>" />



    <x-subjects.submenu :subject="$subject" activeSection="validation-certificate" />

    <style>
        .drag-area {
            border: 2px dashed;
            height: 150px;
            border-radius: 5px;
            border-color: red;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .drag-area.active {
            background-color: #b8d4fe;
            color: black;
            border: 2px dashed blue;
        }

    </style>



    <div class="row">
        <div class="col-12 col-lg-3 mb-3"></div>
        <div class="col-12 col-lg-6 mb-3">
            <h3 class="text-black d-inline-block">Acta PDF</h3>
            <span class="text-muted">(con sello de dirección o de secretaría académica)</span>

            @if ($subject->is_updateable)
                {{--  --}}
                <button class="btn btn-info btn-sm shadow-sm float-right" data-toggle="modal"
                    data-target="#selectCertificateModal">
                    <i class="fas fa-plus"></i>
                    Seleccionar
                </button>
                {{--  --}}

                {{-- select transversal axis button --}}
                <div class="modal fade" id="selectCertificateModal" tabindex="-1" role="dialog"
                    aria-labelledby="selectCertificateModal" aria-hidden="true">
                    <div class="modal-dialog modal-xs modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Cargar acta de validación
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('subjects.certificates.store', [$subject]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <label for="" class="text-muted">SUBIR ARCHIVO EN FORMATO PDF</label>
                                            <div class="kt-card">
                                                <div class="card-body">
                                                    <div class="drag-container">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="" class="text-muted">Fecha de aprobación</label>
                                                        <input value="{{!$subject->certificates()->exists() ? '' : $subject->certificates()->first()->approved_at}}" type="date" class="form-control" name="approved_at" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="" class="text-muted">Fecha de diseño</label>
                                                        <input value="{{!$subject->certificates()->exists() ? '' : $subject->certificates()->first()->designed_at}}" type="date" class="form-control" name="designed_at" required>
                                                    </div>
                                                    <div>
                                                        <label class="text-muted">Fecha de última actualización</label>
                                                        <input value="{{!$subject->certificates()->exists() ? '' : $subject->certificates()->first()->last_update_at}}" type="date" class="form-control" name="last_update_at" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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


            <div class="row">
                <div class="col-12 mb-2">
                    <div class="kt-card">
                        <div class="card-body">
                            @if ($subject->certificates()->exists())

                                <small class="float-right" data-toggle="tooltip" title="fecha de aprobación">
                                    <i class="fas fa-solid fa-calendar"></i>
                                    {{ $subject->certificates()->first()->approved_at }} <br>
                                </small> <br>

                                <div class="border rounded py-1 px-2">
                                    <a target="_blank"
                                        href="{{ route('certificates.download', [$subject->certificates()->first()]) }}"
                                        class="text-info text-center">
                                        <i class="fas fa-download"></i> ver acta de aprobación
                                    </a>
                                </div>
                            @else
                                No se ha cargado ningún acta
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 mb-3">
        </div>

    </div>
    <div class="row">
        @if (auth()->user()->isResponsibleOfSubject($subject))
            <div class="col-12 col-lg-3"></div>
            <div class="col-12 col-lg-6 mb-4">
                <div class="row">
                    <div class="col-12 mb-4">

                        <!-- Button trigger modal -->
                        @if ($subject->is_updateable)
                            <button type="button" class="btn btn-warning btn-sm shadow-sm float-right"
                                data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-solid fa-envelope mr-1"></i>
                                solicitar publicación
                            </button>
                        @endif

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <p>
                                            Antes de solicitar la publicación de la asignatura, asegúrate que hayas
                                            cargado el contenido temático de las diferentes unidades, así como el
                                            acta de aprobación.
                                        </p>

                                        <div class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-danger mr-2"
                                                data-dismiss="modal">
                                                <i class="fas fa-times"></i> cancelar
                                            </button>
                                            <form action="{{ route('subjects.request-publication', [$subject]) }}"
                                                class="d-inline" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm shadow-sm">
                                                    <i class="fas fa-solid fa-envelope mr-1"></i>
                                                    solicitar publicación
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3"></div>
        @endif


    </div>

    <script>
        window.addEventListener("load", function(event) {
            new Draggy(document.querySelector('.drag-container'), {
                inputName: 'certificate_file'
            })
        });

    </script>

</div>
