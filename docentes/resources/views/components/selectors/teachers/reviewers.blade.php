<div x-data="teacherAuthorData($wire)">
    <div class="row mb-3">
        <div class="col-12 col-lg-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text border-0 shadow-sm" id="basic-addon2">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input x-ref="searchIdentifierInput" class="form-control border-0 shadow-sm"
                    placeholder="Buscar autor y/o revisor" x-on:keyup="onSearchTeacher()" aria-label="buscar asignatura"
                    aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <select class="form-control border-0 shadow-sm" x-ref="searchAcademicUnitInput"
                x-on:change="onSearchTeacher()">
                <template x-for="academicUnit in allAcademicUnits" :key="academicUnit.id">
                    <option :value="academicUnit.id" x-text="academicUnit.name"
                        :selected="academicUnitSelected.id === academicUnit.id">
                    </option>
                </template>
            </select>
        </div>
    </div>

    <h5 class="text-black">
        Lista de docentes
    </h5>

    <div class="kt-table-responsive mb-3" style="max-height: 400px; overflow-y: scroll">
        <table class="kt-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nombre</th>
                    <th>email</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="teacher in teachers">
                    <tr x-on:click="onSelectTeacher($event, teacher)" style="cursor: pointer">
                        <td x-text="teacher.identifier"></td>
                        <td x-text="teacher.name"></td>
                        <td x-text="teacher.email"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <h5 class="text-black">
        Lista de docentes seleccionados
    </h5>

    <div class="kt-table-responsive mb-3" style="max-height: 400px; overflow-y: scroll">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>id</th>
                    <th>nombre</th>
                    <th>email</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="teacher in reviewers" :key="teacher.id">
                    <tr>
                        <td>
                            <input type="checkbox" name="reviewer_ids[]" :value="teacher.id" checked
                                x-on:click="onUnselectTeacher(teacher)">
                        </td>
                        <td x-text="teacher.identifier"></td>
                        <td x-text="teacher.name"></td>
                        <td x-text="teacher.email"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-success btn-sm shadow-sm float-right">
        <i class="fas fa-save"></i> Guardar
    </button>
    <button type="button" class="btn btn-outline-danger btn-sm float-right mr-2" data-dismiss="modal"
        aria-label="Close">
        <i class="fas fa-save"></i> Cancelar
    </button>

    <script>
        function teacherAuthorData($wire) {
            return {
                reviewers: @json($reviewers),

                init() {
                },

                async onSelectTeacher(event, teacherToPush) {
                    event.stopPropagation()

                    teacherAlreadySelected = _.find(this.reviewers, function(teacher) {
                        return teacher.id == teacherToPush.id
                    })

                    if (teacherAlreadySelected) {
                        return;
                    }

                    this.reviewers.push(teacherToPush)
                },

                async onUnselectTeacher(teacherToRemove) {

                    this.reviewers = _.filter(this.reviewers, function(teacher) {
                        return teacher.id != teacherToRemove.id
                    })

                },

                async onSearchTeacher() {
                    $wire.teachersWhereAcademicUnit(
                            this.$refs.searchIdentifierInput.value,
                            this.$refs.searchAcademicUnitInput.value
                        )
                        .then(teachers => {
                            this.teachers = new Proxy(JSON.parse(teachers), {})
                        })
                }
            }
        }

    </script>

</div>
