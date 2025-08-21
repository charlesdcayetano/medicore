<?php

namespace App\Imports;


use App\Models\Medicine;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class MedicinesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Convert Excel date to Carbon instance if it's numeric
        $manufacturing_date = is_numeric($row['manufacturing_date'])
            ? Date::excelToDateTimeObject($row['manufacturing_date'])
            : $row['manufacturing_date'];
            
        $expiry_date = is_numeric($row['expiry_date'])
            ? Date::excelToDateTimeObject($row['expiry_date'])
            : $row['expiry_date'];

        return new Medicine([
            'name' => $row['name'],
            'manufacturing_date' => $manufacturing_date,
            'expiry_date' => $expiry_date,
            'batch_number' => $row['batch_number'] ?? null,
            'quantity' => $row['quantity'] ?? null,
            'unit_price' => $row['unit_price'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'manufacturing_date' => ['required', 'date'],
            'expiry_date' => ['required', 'date', 'after:manufacturing_date'],
            'batch_number' => ['nullable', 'string', 'max:50'],
            'quantity' => ['nullable', 'integer', 'min:0'],
            'unit_price' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Medicine name is required.',
            'manufacturing_date.required' => 'Manufacturing date is required.',
            'manufacturing_date.date' => 'Manufacturing date must be a valid date.',
            'expiry_date.required' => 'Expiry date is required.',
            'expiry_date.after' => 'Expiry date must be after manufacturing date.',
            'quantity.min' => 'Quantity cannot be negative.',
            'unit_price.min' => 'Unit price cannot be negative.',
        ];
    }
}