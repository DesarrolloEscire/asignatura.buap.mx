@component('mail::message')
# Asignatura modificable

La asignatura {{$subjectModel->title}} requiere que se realicen modificaciones.

@component('mail::button', ['url' => route('subjects.teachers.show',[$subjectModel])])
Ir a la asignatura
@endcomponent

Gracias,<br>
Ecosistema DES BUAP
@endcomponent