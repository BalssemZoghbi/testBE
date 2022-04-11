<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoltSpireResource extends JsonResource
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
            'Bmaxdesire'=>$this->Bmaxdesire,
            'Bmax' => $this->Bmax,
            'Vsp'=> $this->Vsp,
            'N2c'=> $this->N2c,
            'N1c'=> $this->N1c,
            'prise'=> $this->prise,
            'spire'=> $this->spire,
           
        ];
    }
}
