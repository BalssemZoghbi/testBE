@component('mail::message')
# SACEM INDUSTRIES
Bonjour,
On vous informe que vous êtes accepté, veuillez vous connecter à notre plateforme en cliquant ici s'il vous plaît.
@component('mail::button', ['url' => ' http://localhost:8081/login'])
SACEM
@endcomponent

Merci<br>
@endcomponent
