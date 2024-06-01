<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalWasteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'waste_type' => ['required', 'string'],
            'waste_quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'waste_type.required' => 'Lütfen atık türünü yazınız.',
            'waste_type.string' => 'Lütfen atık türünü metinsel olarak ifade ediniz.',
            'waste_quantity.required' => 'Lütfen atık miktarını giriniz.',
            'waste_quantity.integer' => 'Lütfen atık miktarını sayı olarak ifade ediniz.',
            'waste_quantity.min' => 'Atık adedi en az 1 olmalıdır.',
        ];
    }
}
