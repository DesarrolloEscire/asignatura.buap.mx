<div x-data="data()" wire:ignore>
    <x-commons.backbutton>
        @slot('message','Contenidos temáticos')
        @slot('redirect','/asignaturas/'.$subject->id.'/contenidos')
    </x-commons.backbutton>

    <div class="row">


        <div class="col-md-3"></div>
        <div class="col-12 col-md-6">
            <div class="kt-card">
                <form action="{{ route('units.store', [$subject]) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="" class="text-muted">Nombre</label>
                                <input type="text" class="form-control" name="unit_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button class="btn btn-success btn-sm shadow-sm">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

    <script>
        function data() {
            return {

                searchTerm: "",
                users: [],

                init() {
                    var cleave = new Cleave('.input-time', {
                        numericOnly: true,
                        delimiter: ':',
                        blocks: [2, 2],
                        uppercase: true
                    });
                },

                async onSearchUsers() {
                    const users = await this.$wire.searchUsers(this.searchTerm)
                    this.users = new Proxy(JSON.parse(users), {})
                },

                onSelectResponsible(user) {
                    this.$refs.responsibleName.value = user.name
                    this.$refs.responsibleId.value = user.id
                }
            }
        }
    </script>

</div>
