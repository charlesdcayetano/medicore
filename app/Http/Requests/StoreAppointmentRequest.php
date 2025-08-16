<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
      return [
        'patient_id'=>['required','exists:patients,id'],
        'doctor_id'=>['required','exists:users,id'],
        'department_id'=>['required','exists:departments,id'],
        'room_id'=>['nullable','exists:rooms,id'],
        'scheduled_at'=>['required','date'],
        'status'=>['required','in:Pending,Confirmed,Completed,Cancelled'],
        'notes'=>['nullable','string'],
      ];
    }
}
