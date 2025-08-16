<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
      $id = $this->user->id ?? null;
      $isUpdate = (bool)$id;
      return [
        'name'=>['required','string','max:150'],
        'email'=>['required','email','unique:users,email,'.$id],
        'password'=>[$isUpdate ? 'nullable':'required','string','min:6'],
        'role'=>['required','in:Admin,Staff,Doctor,Patient'],
        'department_id'=>['nullable','exists:departments,id'],
      ];
    }
}
