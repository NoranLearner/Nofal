<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // https://laravel.com/docs/10.x/validation#rule-unique
            'title' => 'required|string|min:5|max:255|unique:categories,title,except,id',
            'slug' => 'unique:categories,slug',
            'description' => 'nullable|max:5000',
            'image' => 'required|image|mimes:png,jpeg,jpg,gif|max:2048',
        ];
    }
}
