{{-- subject's strategies list --}}
<div class="row">
    @forelse ($strategies as $strategy)
        <div class="col-12 mb-3">
            <div class="kt-card">
                <div class="card-body kt-border-left kt-border-secondary">
                    {{ $strategy->description }}
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="kt-card">
                <div class="card-body">
                    <x-shared.empty-box text="Ninguna estrategia o técnica seleccionada" />
                </div>
            </div>
        </div>
    @endforelse
</div>
