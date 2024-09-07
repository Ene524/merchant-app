<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'id' => 'nullable',
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad alanı zorunludur',
            'name.max' => 'Ad alanı en fazla 255 karakter olabilir',
            'email.required' => 'E-posta alanı zorunludur',
            'email.max' => 'E-posta alanı en fazla 255 karakter olabilir',
        ];
    }
}
