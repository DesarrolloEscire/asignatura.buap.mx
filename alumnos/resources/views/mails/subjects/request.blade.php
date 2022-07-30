@component('mail::message')
    # Nueva solicitud para publicar una asignatura

    La plataforma de asignaturas BUAP requiere que revises las asignatura de {{ $subjectModel->title }}
    ({{ $subjectModel->key }})
    para ser publicada

    @component('mail::button', ['url' => route('subjects.contents.show', [$subjectModel])])
        Ver solicitud
    @endcomponent

    Gracias,<br>
    Ecosistema DES BUAP
@endcomponent
