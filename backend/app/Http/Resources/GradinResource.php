<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GradinResource extends JsonResource
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
            'tole'=>$this->tole,
            'diamPropose' => $this->diamPropose,
            'diamNominale'=> $this->diamNominale,
            'pas'=> $this->pas,
            'coeffRemplissage'=> $this->coeffRemplissage,
            'nbrGradin'=> $this->nbrGradin,
            'demiGradin'=> $this->demiGradin,
            'largeur'=> $this->largeur,
            'largeurMin' => $this->largeurMin,
            'epaisseur'=> $this->epaisseur,
            'Sbrut'=> $this->Sbrut,
            'Snette'=> $this->Snette,
            'EpaisseurTot'=> $this->EpaisseurTot,
            'largeurMin'=> $this->largeurMin,
        ];
    }
}
