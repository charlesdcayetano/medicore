<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmbulanceRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
      $id = $this->ambulance->id ?? null;
      return [
        'plate_number'=>['required','string','max:20','unique:ambulances,plate_number,'.$id],
        'status'=>['required','in:Available,On Duty,Maintenance'],
        'driver_name'=>['nullable','string','max:150'],
      ];
    }
}
