@component('mail::message')
# SACEM INDUSTRIES

On vous informe que vous etes accepté, veuillez vous connecter a notre plateforme en cliquant ici s'il vous plait.

@component('mail::button', ['url' => ' http://localhost:8081/login'])
SACEM
@endcomponent

merci,<br>
{{ config('app.name') }}
@endcomponent
