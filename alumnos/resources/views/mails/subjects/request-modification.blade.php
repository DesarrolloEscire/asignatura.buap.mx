@component('mail::message')
# Nueva solicitud para para modificar una asignatura

Se ha solicitado modificar la asignatura {{$subjectModel->title}} ({{$subjectModel->key}}).
El mensaje del responsable es el siguiente:

{{$message}}

@component('mail::button', ['url' => route('subjects.contents.show',[$subjectModel])])
Ir a la asignatura
@endcomponent

Gracias,<br>
Ecosistema DES BUAP
@endcomponent