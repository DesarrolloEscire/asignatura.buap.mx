<div id="mdlOpinion" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('opinions.store')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Cuentanos tu opinión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input name="user_id" value="{{Auth::user()->id}}" type="text" hidden>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="txt_message" class="control-label">Escribe tu mensaje:</label>
                                <textarea name="message" id="txt_message" maxlength="255" rows="5" class="form-control" placeholder="Escribe tu mensaje" title="Escribe tu mensaje"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enviar opinión</button>
                    <button class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
