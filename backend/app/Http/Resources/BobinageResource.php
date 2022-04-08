<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BobinageResource extends JsonResource
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
            'materiau' => $this->materiau,
            'conducteur' => $this->conducteur,
            'type' => $this->type,
        
            
        ];
    }
}
