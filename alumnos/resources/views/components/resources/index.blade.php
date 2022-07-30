<div class="row">
    @if ($resources->count())
        @foreach ($resources as $resource)
            <div class="col-12 mb-3">
                <div class="kt-card">
                    <div class="card-body kt-border-left kt-border-secondary">
                        {{ $resource->description }}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="kt-card">
                <div class="card-body">
                    <x-shared.empty-box text="Ningún recurso didáctico seleccionado" />
                </div>
            </div>
        </div>
    @endif
</div>
