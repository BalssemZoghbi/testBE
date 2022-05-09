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
            'montage'=> $this->montage,
            'echangeurs'=> $this->echangeurs,
            'dielectrique'=> $this->dielectrique,
            'fonctionnement'=> $this->fonctionnement,
            'refroidissement'=> $this->refroidissement,
            'elaborateur'=> $this->elaborateur,
            'user_id'=> $this->user_id,
            'electrique_id'=> $this->electrique_id,
            'garantie_id'=> $this->garantie_id,
            'bobinage_id'=> $this->bobinage_id,
            'gradin_id'=> $this->gradin_id,
            'bobinage_secs_id'=> $this->bobinage_secs_id,
            'volt_spires_id'=> $this->volt_spires_id,
            'pcc_uccs_id'=> $this->pcc_uccs_id,
            'circuitmagnetiques_id'=> $this->circuitmagnetiques_id,
        ];
    }
}
