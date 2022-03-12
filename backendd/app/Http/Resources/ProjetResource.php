<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'appareil' => $this->appareil,
            'reference' => $this->reference,
            'client' => $this->client,
            'refClient' => $this->refClient,
            'temperatureMax'=> $this->temperatureMax,
            'attitudeMax'=> $this->attitudeMax,
            'type'=> $this->type,
            'remplissage'=> $this->remplissage,
            'installation'=> $this->installation,
            'echangeurs'=> $this->echangeurs,
            'dielectrique'=> $this->dielectrique,
            'fonctionnement'=> $this->fonctionnement,
            'refroidissement'=> $this->refroidissement,
        ];
    }
}
