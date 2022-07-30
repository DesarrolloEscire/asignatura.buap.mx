@component('mail::message')
# Estimada/o colega

Te has registrado exitosamente en la plataforma de curso REA BUAP. A continuación se muestran tus credenciales de acceso:

Tu contraseña de acceso a la plataforma de asignaturas BUAP es: {{$plainPassword}}

Para poder accesar a la plataforma, primero necesitas verificar tu cuenta dando click en el siguiente botón:

@component('mail::button', ['url' => route('verify',[ base64_encode($user->identifier) ])])
aceptar invitación
@endcomponent

Gracias,<br>
Ecosistema DES BUAP
@endcomponent