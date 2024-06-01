<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'date_range' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Lütfen başlık yazınız.',
            'title.string' => 'Lütfen başlığı metinsel olarak ifade ediniz.',
            'date_range.required' => 'Lütfen tarih aralığı giriniz.',
        ];
    }
}
