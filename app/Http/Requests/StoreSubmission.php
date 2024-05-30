<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmission extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required|string|max:1000',
            'link' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,zip,rar|max:512000',
        ];
    }
}
