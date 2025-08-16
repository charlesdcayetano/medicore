<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
      $id = $this->room->id ?? null;
      return [
        'number'=>['required','string','max:50','unique:rooms,number,'.$id],
        'type'=>['required','string','max:50'],
        'is_available'=>['nullable','boolean'],
      ];
    }
}
