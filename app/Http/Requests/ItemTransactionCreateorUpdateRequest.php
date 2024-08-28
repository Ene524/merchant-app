<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemTransactionCreateorUpdateRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
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
            'type' => 'required|integer',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Tür zorunludur.',
            'price.required' => 'Fiyat zorunludur.',
            'quantity.required' => 'Miktar zorunludur.',
        ];
    }
}
