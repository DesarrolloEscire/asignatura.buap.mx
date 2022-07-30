<div class="row">
    @forelse ($instruments as $instrument)
        <div class="col-12 mb-3">
            <div class="kt-card">
                <div class="card-body kt-border-left kt-border-secondary">
                    {{ $instrument->description }}
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="kt-card">
                <div class="card-body">
                    <x-shared.empty-box text="Ningún instrumento seleccionado" />
                </div>
            </div>
        </div>
    @endforelse
</div>
