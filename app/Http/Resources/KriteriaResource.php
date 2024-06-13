<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KriteriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //$this from Request $request a.k.a the model because it called form SponsorController
        return [
            'id' => $this->id,
            'name_kriteria' => $this->name_kriteria,
        ];
    }
}
