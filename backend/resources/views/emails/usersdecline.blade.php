@component('mail::message')
# SACEM INDUSTRIES
Bonjour,
On vous informe que vous êtes malheureusement refusé pour accéder à notre plateforme, si vous voulez envoyer une autre demande cliquez ici.
@component('mail::button', ['url' => ' http://localhost:8081/Register'])
SACEM
@endcomponent

Merci<br>

@endcomponent
