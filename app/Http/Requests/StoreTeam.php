<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeam extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_team' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'lomba_id' => 'required|integer|exists:lombas,id',
            'phone' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'payment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
