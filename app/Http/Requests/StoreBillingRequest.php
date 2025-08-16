<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillingRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
      return [
        'patient_id'=>['required','exists:patients,id'],
        'appointment_id'=>['nullable','exists:appointments,id'],
        'due_date'=>['nullable','date'],
        'status'=>['required','in:Unpaid,Partially Paid,Paid,Voided'],
        'items'=>['sometimes','array'],
        'items.*.description'=>['required_with:items','string','max:255'],
        'items.*.quantity'=>['required_with:items','integer','min:1'],
        'items.*.unit_price'=>['required_with:items','numeric','min:0'],
      ];
    }
}
