<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KriteriaLombaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lomba_id' => $this->lomba_id,
            'kriteria_id' => $this->kriteria_id,
            'bobot' => $this->bobot,  
            'name_kriteria' => $this->kriteria ? $this->kriteria->name_kriteria : null, 
        ];
    }
}
