<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLombaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_lomba' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'picture' => ['required', 'image', 'max:2048'], // Memastikan hanya file gambar yang diizinkan
            'sertifikat' => ['required', 'file', 'mimes:pdf', 'max:10240'],
            'pj' => ['required', 'string', 'max:255'],
            'kontak' => ['required', 'string', 'max:255'],
            'tempat' => ['required', 'string', 'max:255'],
            'biaya_pendaftaran' => ['required', 'string', 'max:255'],
            
            
        ];
    }

    public function attributes()
    {
        return [
            'name_lomba' => 'Nama Lomba',
            'description' => 'Deskripsi Lomba',
            'picture' => 'Foto Lomba',
            'sertifikat' => 'Sertifikat Lomba',
            'pj' => 'Nama Penanggung Jawab',
            'kontak' => 'Kontak Penanggung Jawab',
            'tempat' => 'Tempat Lomba',
            'biaya_pendaftaran' => 'Biaya Pendaftaran',
        ];
    }
}
