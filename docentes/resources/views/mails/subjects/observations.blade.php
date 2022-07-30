@component('mail::message')
# Observaciones de revisión de asignatura

La plataforma de asignaturas BUAP requiere que revise las observaciones del programa de asignatura de {{$subjectInformation->subjectModel->title}} ({{$subjectInformation->subjectModel->key}})
realizada el día {{ date_format($subjectInformation->subjectObservationModel->created_at,'d/m/Y') }}.

@component('mail::button', ['url' => route('subjects.contents.show',[$subjectInformation->subjectModel])])
Ver observaciones
@endcomponent

Gracias,<br>
Ecosistema DES BUAP
@endcomponent