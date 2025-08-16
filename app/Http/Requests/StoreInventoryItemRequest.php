<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryItemRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
      $id = $this->inventory->id ?? null;
      return [
        'name'=>['required','string','max:150'],
        'sku'=>['required','string','max:60','unique:inventory_items,sku,'.$id],
        'stock'=>['required','integer','min:0'],
        'unit_price'=>['required','numeric','min:0'],
        'expires_at'=>['nullable','date'],
      ];
    }
}
