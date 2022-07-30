<div x-data="data($wire)" wire:ignore>

    <x-commons.backbutton>
        @slot('message', 'Contenidos temáticos')
            @slot('redirect', '/asignaturas/' . $unit->subjects->first()->id . '/contenidos')
            </x-commons.backbutton>

            <div class="row my-2">
                <div class="col-12">
                    <small class="text-muted">UNIDAD</small> <br>

                    <h3 style="color: black">
                        {{-- {{ $unit->name }} --}}
                        <span x-text="unit.name"></span>
                    </h3>
                    <hr>
                </div>
            </div>


            @if ($unit->subjects()->first()->is_updateable)
                {{-- CREATE TOPIC MODAL BUTTON --}}
                <div class="row mb-3">
                    <div class="col-12">
                        <button class="btn btn-success btn-sm shadow-sm float-right px-3" data-toggle="modal"
                            data-target="#createTopicModal">
                            <small><i class="fas fa-plus mr-1"></i></small> Crear Tema
                        </button>
                    </div>
                </div>
                {{-- CREATE TOPIC MODAL BUTTON --}}

                {{-- CREATE TOPIC MODAL --}}
                <div class="modal fade" id="createTopicModal" tabindex="-1" role="dialog"
                    aria-labelledby="createTopicModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                    MA</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="" class="text-muted text-uppercase">
                                    NOMBRE
                                </label>
                                <input type="text" class="form-control" x-ref="topicTitle" placeholder="título del nuevo tema"
                                    maxlength="190" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary shadow-sm" x-on:click="onCreateTopic()">
                                    <i class="fas fa-save"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- CREATE TOPIC MODAL --}}
            @endif

            <div class="row" id="topics" x-ref="topics">
                {{-- @foreach ($unit->topics as $topic) --}}
                <template x-for="(topic, topicIndex) in unit.topics" :key="topic.id" data-id="0">
                    <div class="col-12 mb-4" :data-id="topic.id">
                        <div class="card border-0 shadow mb-2">
                            <div class="card-body d-inline-block bg-primary text-white">
                                @if ($unit->subjects()->first()->is_updateable)
                                    <i class="sortable-topics-button fas fa-grip-vertical mr-3" style="cursor: move;"></i>
                                @endif
                                {{-- {{ $topic->title }} --}}
                                <span x-text="topic.title"></span>
                                @if ($unit->subjects()->first()->is_updateable)
                                    <span class="dropdown float-right" href="#" id="topicDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </span>
                                    <div class="dropdown-menu shadow" aria-labelledby="topicDropdown">
                                        {{-- <div class="dropdown-divider"></div> --}}
                                        <a class="dropdown-item text-danger" href="javascript:void(0)"
                                            x-on:click="onDeleteTopic(topic.id)">
                                            <i class="fas fa-trash fa-sm fa-fw mr-2"></i>
                                            Eliminar
                                        </a>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="row subtopics" :id="`subtopics-container-${topic.id}`" :topic-id="topic.id">
                            <template x-for="(subtopic, subtopicIndex) in topic.subtopics" :key="subtopic.id" data-id="0"
                                class="no-draggable">
                                <div class="col-12 draggable" :data-id="subtopic.id">
                                    <div class="ml-3 card border-0 shadow mb-2">
                                        <div class="card-body d-inline-block kt-border-left kt-border-secondary">
                                            <div class="row">
                                                <div class="col-12">
                                                    {{-- (<span x-text="subtopic.position"></span>) --}}

                                                    @if ($unit->subjects()->first()->is_updateable)
                                                        <i class="sortable-button fas fa-grip-vertical mr-3"
                                                            style="cursor: move;"></i>
                                                        <!-- Dropdown - User Information -->
                                                        <div class="dropdown d-inline-block float-right">
                                                            <span class="dropdown float-right" href="#"
                                                                id="subtopicMenuDropdown" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </span>
                                                            <div class="dropdown-menu shadow"
                                                                aria-labelledby="subtopicMenuDropdown">
                                                                <a class="dropdown-item text-danger" href="javascript:void(0)"
                                                                    x-on:click="ondeleteSubtopic(subtopic.id)">
                                                                    <i class="fas fa-trash fa-sm fa-fw mr-2"></i>
                                                                    Eliminar
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-12">
                                                    <span x-text="subtopic.title"></span>
                                                </div>
                                            </div>
                                            <!-- Nav Item - User Information -->


                                        </div>

                                    </div>
                                    {{-- CREATE GOAL BUTTON --}}
                                </div>
                            </template>
                        </div>
                        @if ($unit->subjects()->first()->is_updateable)
                            <div class="row">
                                <div class="col-12 text-right mb-2">
                                    <button class="btn btn-success btn-sm px-3 shadow-sm" data-toggle="modal"
                                        data-target="#createSubtopicModal" x-on:click="newSubtopic.topic_id = topic.id">
                                        <small><i class="fas fa-plus mr-1"></i></small>
                                        <span>
                                            Crear Subtema
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </template>
            </div>




            {{-- GOAL MODAL --}}
            <div class="modal fade" id="createSubtopicModal" tabindex="-1" role="dialog"
                aria-labelledby="createSubtopicModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content border-0">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="exampleModalLongTitle">CREAR SUBTEMA</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="" class="text-muted text-uppercase">
                                    Oración
                                </label>
                                <input type="text" x-model="newSubtopic.title" class="form-control"
                                    placeholder="nombre del nuevo subtema" maxlength="191" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
                                <i class="fas fa-times"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-primary shadow-sm" x-on:click="onCreateSubtopic()">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- GOAL MODAL --}}

            {{-- @endpush --}}

            {{-- bibliographies --}}

            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="text-black d-inline-block">
                        <span>BIBLIOGRAFÍA</span>
                    </h3>

                    @if ($unit->subjects()->first()->is_updateable)
                        <button class="btn btn-success btn-sm shadow-sm float-right" data-toggle="modal"
                            data-target="#createBibliographyModal">
                            <small><i class="fas fa-plus"></i></small> Nueva Bibliografía
                        </button>

                        <div class="modal fade" id="createBibliographyModal" tabindex="-1" role="dialog"
                            aria-labelledby="createBibliographyModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content border-0">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="exampleModalLongTitle">CREAR BIBLIOGRAFÍA</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <a target="_blank" href="https://bibliotecas.buap.mx/portal/resources/digitalLibrary" class="text-info float-right">
                                            <i class="fas fa-lightbulb"></i>
                                            consulta la Biblioteca Digital
                                        </a>
                                        <label for="" class="text-muted text-uppercase">
                                            BIBLIOGRAFÍA
                                        </label>
                                        <textarea name="bibliography_content" cols="30" rows="10" class="ckeditor"
                                            placeholder="escribe tu bibliografía aquí..."
                                            x-ref="bibliographyContentTextarea"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary shadow-sm"
                                            x-on:click="onCreateBibliography()">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>


            <div class="row mb-4">
                <template x-for="bibliography in unit.bibliographies" :key="bibliography.id">
                    <div class="col-12 mb-2">
                        <div class="card rounded-0 shadow-sm kt-border-left">
                            <div class="card-body">
                                @if ($unit->subjects()->first()->is_updateable)
                                    <button class="btn btn-danger btn-sm shadow-sm float-right"
                                        x-on:click="onDeleteBibliography(bibliography)">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                @endif
                                <span x-html="bibliography.content"></span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>


            {{-- end bibliographies --}}

        </div>

        @push('scripts')
            <script>
                class Alert {

                    static success(message) {
                        Swal.fire(
                            '¡operación exitosa!',
                            message,
                            'success'
                        )
                    }

                    static error(message) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Upps',
                            text: message,
                        })
                    }

                }

                function data($wire) {
                    return {

                        load: true,
                        unit: @json($unit),

                        newSubtopic: {
                            "title": "",
                            "topic_id": "",
                            "minutes": "",
                        },

                        init() {

                            Livewire.on('unit-updated', postId => {
                                this.unitUpdated()
                            })
                            Livewire.on('subtopic-moved', () => {
                                this.subtopicMoved()
                            })
                            Livewire.on('topic-moved', () => {
                                this.topicMoved()
                            })

                            this.unitUpdated()

                            this.applySortableForTopics()

                            this.$nextTick(this.applySortableForSubtopics);

                        },

                        async applySortableForTopics() {
                            const topics = document.getElementById("topics")

                            Sortable.create(topics, {
                                group: {
                                    name: "topics"
                                },
                                animation: 150,
                                easing: "cubic-bezier(0.5, 0, 0.75, 0)",
                                handle: ".sortable-topics-button",
                                ghostClass: "invisible",

                                store: {
                                    set: async (sortable) => {
                                        await this.$wire.changeTopicPositions(
                                            sortable.toArray()
                                        )

                                        await this.$wire.emit('topic-moved')
                                    }
                                }
                            });
                        },

                        async applySortableForSubtopics() {
                            const subtopics = document.getElementsByClassName("subtopics")

                            Array.from(document.getElementsByClassName("subtopics")).forEach(function(subtopic) {
                                Sortable.create(subtopic, {
                                    group: {
                                        name: "subtopics"
                                    },
                                    animation: 150,
                                    easing: "cubic-bezier(0.5, 0, 0.75, 0)",
                                    handle: ".sortable-button",
                                    ghostClass: "invisible",
                                    filter: ".no-draggable",

                                    onEnd: async function(event) {

                                        const subtopicId = event.clone.getAttribute('data-id')
                                        const postId = event.to.getAttribute('topic-id')

                                        await $wire.moveSubtopic(
                                            subtopicId,
                                            postId,
                                            event.newIndex
                                        )

                                        await $wire.emit('subtopic-moved')
                                    },
                                });
                            });
                        },

                        async onCreateTopic() {

                            const newTopicTitle = this.$refs.topicTitle.value;

                            if (!newTopicTitle) {
                                Alert.error('El título no puede estar vacío')
                                return
                            }

                            await $wire.createTopic(newTopicTitle)

                            await this.unitUpdated()

                            this.applySortableForSubtopics()

                            this.$refs.topicTitle.value = ""

                            Alert.success('El tema ha sido creado exitosamente')
                            $('#createTopicModal').modal('hide');
                        },

                        async onDeleteTopic(topicId) {

                            Swal.fire({
                                title: '¿Estás seguro?',
                                text: "No podrás recuperár el tema eliminado",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Sí, eliminar'
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    await $wire.deleteTopic(topicId)

                                    this.unitUpdated()

                                    Alert.success('El tema ha sido eliminado exitosamente')
                                }
                            })

                        },

                        onCreateSubtopic(topicId) {

                            try {
                                UnitService.validateSubtopicCreation(this.unit, this.newSubtopic)
                            } catch (error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Upps',
                                    text: error,
                                })
                                return
                            }

                            this.$wire.createSubtopic(
                                this.newSubtopic.topic_id,
                                moment.duration(this.newSubtopic.minutes).asMinutes(),
                                this.newSubtopic.title
                            ).then(async (subtopic) => {
                                unit = await $wire.unitUpdated()
                                this.unit = new Proxy(JSON.parse(unit), {})
                            }).then(() => {
                                Swal.fire(
                                    'Subtema creado',
                                    'El subtema ha sido creado exitosamente',
                                    'success'
                                )
                                $('#createSubtopicModal').modal('hide');
                            })
                        },

                        async ondeleteSubtopic(subtopicId) {

                            Swal.fire({
                                title: '¿Estás seguro?',
                                text: "No podrás recuperár el subtema eliminado",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Sí, eliminar'
                            }).then(async (result) => {
                                if (result.isConfirmed) {
                                    await $wire.deleteSubtopic(subtopicId)
                                    this.unitUpdated()
                                    Swal.fire(
                                        'Subtema eliminado',
                                        'El subtema ha sido eliminado exitosamente',
                                        'success'
                                    )
                                }
                            })




                        },

                        async unitUpdated() {
                            unit = await $wire.unitUpdated()
                            this.unit = new Proxy(JSON.parse(unit), {})
                        },

                        async topicMoved() {
                            // update entire unit data
                            unit = await $wire.unitUpdated()
                            unit = new Proxy(JSON.parse(unit), {})
                            this.unit = unit

                            this.$nextTick(this.reorderTopics)
                            this.$nextTick(this.applySortableForTopics)
                        },

                        async subtopicMoved() {

                            // update entire unit data
                            unit = await $wire.unitUpdated()
                            unit = new Proxy(JSON.parse(unit), {})
                            this.unit = unit

                            this.$nextTick(this.reorderSubtopics)

                        },

                        reorderSubtopics() {
                            subtopicInputs = document.getElementsByClassName("subtopics")

                            for (let index = 0; index < subtopicInputs.length; index++) {
                                sortable = Sortable.get(subtopicInputs[index])
                                const subtopicCollection = SubtopicCollection.create(this.unit.topics[index].subtopics)
                                newOrder = [sortable.toArray()[index]].concat(subtopicCollection.pluckId())
                                sortable.sort(newOrder)
                            }
                        },

                        reorderTopics() {
                            const sortable = Sortable.get(document.getElementById("topics"))
                            const topicCollection = TopicCollection.create(this.unit.topics)
                            const newOrder = topicCollection.pluckId()
                            sortable.sort(newOrder)
                        },

                        async onCreateBibliography() {
                            const bibliographyContent = CKEDITOR.getData()

                            if (!bibliographyContent) {
                                return
                            }


                            await $wire.createBibliography(bibliographyContent)
                            $('#createBibliographyModal').modal('hide');
                            this.unitUpdated()
                        },

                        async onDeleteBibliography(bibliography) {
                            await $wire.deleteBibliography(bibliography.id)
                            this.unitUpdated()
                        },

                    }
                }

                class TopicCollection {
                    constructor(topics) {
                        this.topics = topics
                    }

                    pluckId() {
                        return _.map(this.topics, (topic) => topic.id.toString())
                    }

                    static create(topics) {
                        return new TopicCollection(topics)
                    }
                }

                class SubtopicCollection {

                    constructor(subtopics) {
                        this.subtopics = subtopics
                    }

                    pluckId() {
                        return _.map(this.subtopics, (subtopic) => subtopic.id.toString())
                    }

                    static create(subtopics) {
                        return new SubtopicCollection(subtopics)
                    }

                }

                class UnitService {

                    static minutes(unit) {
                        const sum = _.sumBy(unit.topics, (topic) => topic.minutes)
                        return sum
                    }

                    static topicTitleExists(unit, topicTitle) {
                        const topic = _.find(unit.topics, (topic) => {
                            return topic.title.toLowerCase() == topicTitle.toLowerCase()
                        })

                        return topic ? true : false;
                    }

                    static validateSubtopicCreation(unit, newSubtopic) {}

                }

            </script>

        @endpush
