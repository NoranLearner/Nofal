<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255|unique:products,name,except,id',
            'slug' => 'unique:products,slug',
            'price' => 'required|numeric|gt:0',
            'image.*' => 'required|image|mimes:png,jpeg,jpg,gif|max:2048',
            'amount' => 'required|numeric',
            'expiration' => 'required|in:valid,expire',
            'cat_id' => 'required|exists:categories,id',
        ];
    }
}
