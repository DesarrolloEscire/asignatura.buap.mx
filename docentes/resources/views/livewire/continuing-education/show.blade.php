<div x-data="data()">

        <x-shared.title title="CCP" subtitle="En esta sección verás información relacionada al CCP" />

        <iframe frameBorder="0" src="https://serviciosdes.buap.mx/calificacionccp/?id_docente={{ auth()->user()->identifier }}"
            title="CCP" style="overflow:hidden;height:500px;width:100%" height="500px" width="100%"
            onload="this.width=screen.width;this.height=screen.height;"></iframe>

    <script>
        function data() {
            return {
                init() {
                    Swal.fire(
                        'Educación continua',
                        'Es el medio para continuar perfeccionando un conocimiento, con la finalidad de aportar favorablemente, a través del conocimiento y las habilidades, al crecimiento profesional o laboral.'
                    )
                }
            }
        }

    </script>

</div>
