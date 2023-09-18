<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|string|min:5|max:255|regex:/^[a-zA-Z0-9\S]*$/i',
            'description'=>'nullable|max:5000',
            'image'=>'required|image|mimes:png,jpeg,jpg,gif|max:2048',
        ];
    }
}
