<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
            'registry_number' => ['required', 'integer'],
            'specialization' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Lütfen listeden bir personel seçiniz.',
            'user_id.integer' => 'Lütfen listeden bir personel seçiniz.',
            'user_id.exists' => 'Lütfen sayfayı yenileyerek işlemi tekrar gerçekleştirin.',
            'user_id.unique' => 'Sistemde zaten kayıtlı olan bir doktoru ekleyemezsiniz.',
            'registry_number.required' => 'Lütfen sicil numarasını giriniz.',
            'registry_number.numeric' => 'Sicil numarası sayısal bir değer olmalıdır.',
            'specialization.required' => 'Lütfen uzmanlık alanını giriniz.',
            'specialization.string' => 'Uzmanlık alanı metinsel bir değer olmalıdır.',
        ];
    }
}
