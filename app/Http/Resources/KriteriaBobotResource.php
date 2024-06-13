<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KriteriaBobotResource extends JsonResource
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
            'bobot_id' => $this->bobot_id,
            'kriteria_id' => $this->kriteria_id,
            'name_kriteria' => $this->kriteria->name_kriteria,  // Ambil nama kriteria dari relasi
            'nilai_bobot' => $this->bobot->nilai_bobot,  
        ];
    }
}
