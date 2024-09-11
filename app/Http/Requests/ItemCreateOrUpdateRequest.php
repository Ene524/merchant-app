<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemCreateOrUpdateRequest extends FormRequest
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
            'name' => 'required|unique:items,name,' . $this->id . ',id,server_id,' . $this->server_id,
            'server_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Item adı alanı zorunludur.',
            'name.string' => 'Item adı alanı metin tipinde olmalıdır.',
            'server_id.required' => 'Server seçimi zorunludur'
        ];
    }
}
