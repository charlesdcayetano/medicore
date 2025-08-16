<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
      $id = $this->department->id ?? null;
      return [
        'name'=>['required','string','max:150'],
        'code'=>['required','string','max:20','unique:departments,code,'.$id],
      ];
    }
}
