<div x-data="data()">

    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <a class="btn btn-info btn-sm" href="{{ route('units.create') }}">
                <small><i class="fas fa-plus"></i></small>
                Crear unidad
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            @foreach ($units as $unit)
                <div class="kt-card">
                    <div class="card-body kt-border-left kt-border-secondary">
                        <div class="text-right mb-1">
                            @if ($unit->is_completed)
                                <span class="badge badge-success px-2">Completado</span>
                            @else
                                <span class="badge badge-danger px-2">No Completado</span>
                            @endif
                        </div>
                        <p>{{ $unit->name }}</p>
                        <span>
                            <i>
                                <small>
                                    <i class="fas fa-user"></i>
                                    Responsable
                                </small> <br>
                            </i>
                            <b>
                                {{ !$unit->users()->exists() ? 'N/A' : $unit->users()->first()->name }}
                            </b>

                            <a href="{{route('didactic-plannings.show')}}" class="text-info float-right">
                                Ver planeación didactica
                            </a>
                        </span>
                        <hr>
                        <div class="d-inline-block">
                            <a href="{{ route('units.show', [$unit]) }}"
                                class="btn btn-primary btn-sm px-2 shadow-sm">
                                <i class="fas fa-eye"></i> Ver detalles
                            </a>
                        </div>
                        {{-- <span class="float-right">
                            <i class="fas fa-clock"></i>
                            <span class="minutes-text">
                            </span>
                            Horas
                        </span> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function data() {
            return {
                init() {

                    let minuteInputs = document.getElementsByClassName('minutes-text')

                    Array.from(document.getElementsByClassName("minutes-text")).forEach(function(input) {
                        input.innerText = MomentService.formatMinutes(input.innerText)
                    });

                }
            }
        }

        class MomentService {

            /**
             * format minutes integer to hours
             * even if it is more than 24 hours
             */
            static formatMinutes(minutes) {

                var dur = moment.duration(minutes, 'minutes');
                var hours = Math.floor(dur.asHours());
                hours = hours > 9 ? hours : "0" + hours;
                var mins = Math.floor(dur.asMinutes()) - hours * 60;
                mins = mins > 9 ? mins : "0" + mins
                var result = hours + ":" + mins;
                return result
            }
        }

    </script>

</div>
