<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function onCreate(){
        return [
            'title'=>'required|string|unique:posts|min:5|max:255|regex:/^[a-zA-Z0-9\S]*$/i',
            'author'=>'string|nullable',
            'body'=>'nullable|max:5000',
            'cover'=>'required|image|mimes:png,jpeg,jpg,gif|max:2048',
            'images.*'=>'image|mimes:png,jpeg,jpg,gif|max:2048',
        ];
    }

    protected function onUpdate(){
        return [
            /* 'title'=>'required|string|unique:posts,title|min:5|max:255|regex:/^[a-zA-Z0-9\S]*$/i',
            'author'=>'string|nullable',
            'body'=>'nullable|max:5000',
            'cover'=>'image|mimes:png,jpeg,jpg,gif|max:2048',
            'images.*'=>'image|mimes:png,jpeg,jpg,gif|max:2048', */
            'title' => [
                'required',
                'string',
                Rule::unique('posts', 'title')->ignore($this->post),
                'min:5',
                'max:255',
                'regex:/^[a-zA-Z0-9\S]*$/i'
            ],
            'author' => [
                'string',
                'nullable'
            ],
            'body' => [
                'nullable',
                'max:5000'
            ],
            'cover' => [
                'image',
                'mimes:png,jpeg,jpg,gif',
                'max:2048'
            ],
            'images.*'=> [
                'image',
                'mimes:png,jpeg,jpg,gif',
                'max:2048'
            ]
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    public function messages(): array
    {
        return [
            'title.regex' => 'The title format is invalid, Title may contain english characters or numbers and not space!',
        ];
    }
}
