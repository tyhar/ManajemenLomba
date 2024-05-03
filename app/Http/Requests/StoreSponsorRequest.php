<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSponsorRequest extends FormRequest
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
            'deskripsi' => ['required', 'string', 'max:500'],
            'images' => ['required', 'image', 'max:2048'], // Memastikan hanya file gambar yang diizinkan
            'sertifikat' => ['required', 'file', 'mimes:pdf,jpeg,png,jpg,', 'max:2048'], // Memastikan hanya file dengan ekstensi tertentu yang diizinkan
            'nama_pj' => ['required', 'string', 'max:255'],
            'kontak_pj' => ['required', 'string', 'max:255'],
            'tempat' => ['required', 'string', 'max:255'],
            'biaya_pendaftaran' => ['required', 'string', 'max:255'],
            
            
        ];
    }

    public function attributes()
    {
        return [
            'name_lomba' => 'Nama Lomba',
            'deskripsi' => 'Deskripsi Lomba',
            'images' => 'Foto Lomba',
            'sertifikat' => 'Sertifikat Lomba',
            'nama_pj' => 'Nama Penanggung Jawab',
            'kontak_pj' => 'Kontak Penanggung Jawab',
            'tempat' => 'Tempat Lomba',
            'biaya_pendaftaran' => 'Biaya Pendaftaran',
        ];
    }
}
