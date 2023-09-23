<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterationRequest extends FormRequest
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
            'name' => 'required|string|between:2,100',
            // To match 1 - 3 digits only preceded with a plus
            'country_code' => 'required|regex:/^\+\d{1,3}$/',
            'phone' => 'required|numeric|digits_between:10,20|unique:users,phone',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required',
        ];
    }
}
