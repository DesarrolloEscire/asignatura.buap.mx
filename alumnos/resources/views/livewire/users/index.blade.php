<div x-data="data()">

    <div class="row">
        <div class="col-12 mb-3">
        </div>
    </div>

    <div class="row">
        <template x-for="user in users" :key="user.id">
            <div class="col-12 col-md-6 mb-3">
                <div class="kt-card">
                    <div class="card-body">

                        <span class="mb-1" x-text="user.names"></span>
                        <span class="float-right badge"
                            :class=" user.email_verified_at ? 'badge-success' : 'badge-danger' "
                            x-text="user.email_verified_at ? 'verificado' : 'no verificado'"></span> <br>
                        <span>
                            <i>
                                <small>
                                    <i class="fas fa-user-tag"></i>
                                    Rol
                                </small>
                                <br>
                            </i>
                            <b>
                                [role]
                            </b>
                        </span>
                        <hr>
                        <div>
                            <button class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

</div>

@push('scripts')
    <script>
        function data() {
            return {
                users: @json($users),
                init() {
                }
            }
        }

    </script>
@endpush
