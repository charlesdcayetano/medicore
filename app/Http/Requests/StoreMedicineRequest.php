<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole(['Admin', 'Staff']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:medicines,name',
            'description' => 'nullable|string',
            'generic_name' => 'nullable|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'dosage_form' => 'nullable|string|max:255',
            'strength' => 'nullable|string|max:255',
            'quantity_in_stock' => 'required|integer|min:0',
            'minimum_stock_level' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'manufacturer' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date|after:today',
            'batch_number' => 'nullable|string|max:255',
            'status' => 'required|in:Active,Inactive,Discontinued',
            'side_effects' => 'nullable|string',
            'contraindications' => 'nullable|string',
            'storage_instructions' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Medicine name is required.',
            'name.unique' => 'A medicine with this name already exists.',
            'quantity_in_stock.required' => 'Stock quantity is required.',
            'quantity_in_stock.min' => 'Stock quantity cannot be negative.',
            'minimum_stock_level.required' => 'Minimum stock level is required.',
            'minimum_stock_level.min' => 'Minimum stock level cannot be negative.',
            'unit_price.required' => 'Unit price is required.',
            'unit_price.min' => 'Unit price cannot be negative.',
            'expiry_date.after' => 'Expiry date must be in the future.',
            'status.in' => 'Invalid status selected.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'medicine name',
            'generic_name' => 'generic name',
            'brand_name' => 'brand name',
            'dosage_form' => 'dosage form',
            'quantity_in_stock' => 'stock quantity',
            'minimum_stock_level' => 'minimum stock level',
            'unit_price' => 'unit price',
            'expiry_date' => 'expiry date',
            'batch_number' => 'batch number',
            'side_effects' => 'side effects',
            'contraindications' => 'contraindications',
            'storage_instructions' => 'storage instructions',
        ];
    }
}
