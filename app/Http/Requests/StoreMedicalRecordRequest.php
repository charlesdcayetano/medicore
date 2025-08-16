<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalRecordRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
      return [
        'patient_id'=>['required','exists:patients,id'],
        'doctor_id'=>['required','exists:users,id'],
        'visit_date'=>['required','date'],
        'diagnosis'=>['nullable','string','max:255'],
        'treatment'=>['nullable','string'],
        'notes'=>['nullable','string'],
      ];
    }
}
