<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LombaResource extends JsonResource
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
            'name_lomba' => $this->name_lomba,
            'description' => $this->description,
            'kontak' => $this->kontak,
            'pj' => $this->pj,
            'picture' => $this->picture,
            'tempat' => $this->tempat,
            'sertifikat' => $this->sertifikat,
            'biaya_pendaftaran' => $this->biaya_pendaftaran,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
