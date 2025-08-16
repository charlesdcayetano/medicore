<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
      return [
        'medical_record_id'=>['required','exists:medical_records,id'],
        'prescribed_on'=>['required','date'],
        'items'=>['sometimes','array'],
        'items.*.drug_name'=>['required_with:items','string','max:150'],
        'items.*.dosage'=>['nullable','string','max:100'],
        'items.*.frequency'=>['nullable','string','max:100'],
        'items.*.days'=>['nullable','integer','min:1'],
      ];
    }
}
