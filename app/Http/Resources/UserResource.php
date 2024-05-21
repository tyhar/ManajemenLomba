<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'username' => $this->username,
            'instansi' => $this->instansi,
            'phone' => $this->phone,
            'email_verification_status' => $this->email_verification_status,
            'date' => $this->date,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'photo' => $this->photo,
            'created_at' => $this->created_at,

        ];
    }
}
