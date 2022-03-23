<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ElectriqueResource extends JsonResource
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
            'frequence' => $this->frequence,
            'pn' => $this->pn,
            'u1n' => $this->u1n,
            'u2o' => $this->u2o,
            'couplagePrimaire'=> $this->couplagePrimaire,
            'couplageSecondaire'=> $this->couplageSecondaire,
            'indiceHoraire'=> $this->indiceHoraire,
            'couplage'=> $this->couplage,
            'priseSoustractive'=> $this->priseSoustractive,
            'priseAdditive'=> $this->priseAdditive,
            'echelonSousctractive'=> $this->echelonSousctractive,
            'echelonAdditive'=> $this->echelonAdditive,
            'variation'=> $this->variation,
            'puissance'=> $this->puissance,
            'PrimaireUligne'=> $this->PrimaireUligne,
            'PrimaireUPhase'=> $this->PrimaireUPhase,
            'PrimaireIligne'=> $this->PrimaireIligne,
            'PrimaireIligne'=> $this->PrimaireIligne,
            'secondaireUligne'=> $this->secondaireUligne,
            'secondaireUPhase'=> $this->secondaireUPhase,
            'secondaireIligne'=> $this->secondaireIligne,
            'secondaireIPhase'=> $this->secondaireIPhase,
        ];
    }
}
