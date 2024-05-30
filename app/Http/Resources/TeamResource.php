<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);  [

            'id' => $this->id,
            'name_team' => $this->name_team,
            'email' => $this->email,
            'phone' => $this->phone,
            'instansi' => $this->instansi,
            'payment' => $this->payment,
            'status' => $this->status,
            'lombas' => LombaResource::collection($this->whenLoaded('lombas')),

            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,

        ];
    }
}
