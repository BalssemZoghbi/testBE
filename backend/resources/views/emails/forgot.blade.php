@component('mail::message')
# SACEM INDUSTRIES

Pour changer votre mot de passe , cliquez ici.

@component('mail::button', ['url' => 'http://localhost:8080/reset/'.$token])
Réinitialiser votre mot de passe
@endcomponent

Merci !
@endcomponent



