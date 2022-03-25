@component('mail::message')
# SACEM INDUSTRIES

On vous informe que vous etes malhereusement refusé pour acceder a notre plateforme, si vous voulez envoyer une autre demande cliquez ici.

@component('mail::button', ['url' => ' http://localhost:8081/Register'])
SACEM
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
