<div class="row">
    @forelse ($competences as $competence)
        <div class="col-12 mb-3">
            <div class="kt-card">
                <div class="card-body kt-border-left kt-border-secondary">
                    <tr>
                        {{ $competence->description }}
                        <span class="float-right badge badge-secondary">
                            {{ $competence->type }}
                        </span>
                    </tr>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="kt-card">
                <div class="card-body">
                    <x-shared.empty-box text="Ninguna competencia profesional seleccionada" />
                </div>
            </div>
        </div>
    @endforelse
    {{-- @endforeach --}}
</div>