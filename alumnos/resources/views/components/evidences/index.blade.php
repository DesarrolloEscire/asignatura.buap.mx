<div class="row">
    @forelse ($evidences as $evidence)
        <div class="col-12 mb-3">
            <div class="kt-card">
                <div class="card-body kt-border-left kt-border-secondary">
                    {{ $evidence->description }}
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="kt-card">
                <div class="card-body">
                    <x-shared.empty-box text="Ninguna evidencia seleccionada" />
                </div>
            </div>
        </div>
    @endforelse
</div>
