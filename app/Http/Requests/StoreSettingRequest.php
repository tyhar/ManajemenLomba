<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
            'name_event' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'title_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'logo1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=180,max_height=55',
            'logo2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=1200,max_height=800',
            'logo3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:max_width=450,max_height=450',
            
        ];
    }

    public function attributes()
    {
        return [
            'name_event' => 'Nama Event',
            'title' => 'Judul Event',
            'sub_title' => 'Sub Judul ',
            'date_strat' => 'Tanggal Mulai',
            'date_end' => 'Tanggal Berakhir',
            'title_description' => 'Judul Deskripsi',
            'logo1' => 'Logo 1',
            'logo2' => 'Logo 2',
            'logo3' => 'Logo 3',
        ];
    }
}
