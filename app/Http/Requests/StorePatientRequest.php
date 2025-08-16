<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
      return [
        'first_name'=>['required','string','max:100'],
        'last_name' =>['required','string','max:100'],
        'email'     =>['nullable','email','unique:patients,email,'.($this->patient->id ?? 'NULL')],
        'contact_number'=>['nullable','string','max:30'],
        'gender'    =>['nullable','in:Male,Female,Other'],
        'date_of_birth'=>['nullable','date'],
        'address'=>['nullable','string','max:255'],
        'emergency_contact'=>['nullable','string','max:255'],
      ];
    }
}
