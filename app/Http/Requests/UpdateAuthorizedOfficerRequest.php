<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorizedOfficerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Lütfen listeden bir personel seçiniz.',
            'user_id.integer' => 'Lütfen listeden bir personel seçiniz.',
            'user_id.exists' => 'Lütfen sayfayı yenileyerek işlemi tekrar gerçekleştirin.',
            'user_id.unique' => 'Sistemde zaten kayıtlı olan bir doktoru ekleyemezsiniz.',
        ];
    }
}
