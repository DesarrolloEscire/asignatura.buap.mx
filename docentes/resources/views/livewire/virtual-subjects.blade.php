<div>

    <x-shared.title title="Asignaturas virtuales" subtitle="En esta sección verás información relacionada a las asignaturas virtuales" />

    <iframe frameBorder="0" src="https://serviciosdes.buap.mx/registromoodle/?clavedep={{ auth()->user()->academicUnits()->first()->key }}"
        title="CCP" style="overflow:hidden;height:500px;width:100%" height="500px" width="100%"
        onload="this.width=screen.width;this.height=screen.height;"></iframe>
</div>
