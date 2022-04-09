@component('mail::message')
# SACEM INDUSTRIES

Pour changer votre mot de passee , cliquez ici.

@component('mail::button', ['url' => 'http://localhost:8080/reset/.{{$token}}'])
Reset your password
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent



