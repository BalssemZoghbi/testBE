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
            'colonnes' => $this->colonnes,
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
            'classeU1' =>$this->classeU1,
            'tenueFr1' =>$this->tenueFr1,
            'tenueChoc1' =>$this->tenueChoc1,
            'classeU2' =>$this->classeU2,
            'tenueFr2' =>$this->tenueFr2,
            'tenueChoc2' =>$this->tenueChoc2,
            'puissance'=> $this->puissance,
            'PrimaireUligne'=> $this->PrimaireUligne,
            'PrimaireUPhase'=> $this->PrimaireUPhase,
            'PrimaireIligne'=> $this->PrimaireIligne,
            'PrimaireIPhase'=> $this->PrimaireIPhase,
            'secondaireUligne'=> $this->secondaireUligne,
            'secondaireUPhase'=> $this->secondaireUPhase,
            'secondaireIligne'=> $this->secondaireIligne,
            'secondaireIPhase'=> $this->secondaireIPhase,
            'Uz'=> $this->Uz,
            'nbrePosition'=> $this->nbrePosition,
        ];
    }
}
