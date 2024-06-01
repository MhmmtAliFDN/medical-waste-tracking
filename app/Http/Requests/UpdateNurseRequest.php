<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNurseRequest extends FormRequest
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
            'department' => ['required', 'string'],
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
            'department.required' => 'Lütfen departman adı giriniz.',
            'department.string' => 'Departman alanı metinsel bir ifade olmalıdır.',
        ];
    }
}
