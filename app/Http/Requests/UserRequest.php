<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'id'=>'nullable',
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad alanı zorunludur',
            'name.max' => 'Ad alanı en fazla 255 karakter olabilir',
            'email.required' => 'E-posta alanı zorunludur',
            'email.unique' => 'Bu e-posta adresi zaten kullanılmaktadır',
            'email.max' => 'E-posta alanı en fazla 255 karakter olabilir',
            'password.required' => 'Şifre alanı zorunludur',
            'password.max' => 'Şifre alanı en fazla 255 karakter olabilir',
        ];
    }
}
