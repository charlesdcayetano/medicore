<?php

namespace App\Imports;

use App\Models\Patient;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PatientsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Handle Excel date format (numeric serials)
        $dob = is_numeric($row['dob'])
            ? Date::excelToDateTimeObject($row['dob'])->format('Y-m-d')
            : $row['dob'];

        // Prevent duplicates: update if patient already exists
        return Patient::updateOrCreate(
            [
                'name' => $row['name'],
                'dob'  => $dob,
            ],
            [
                'gender'  => $row['gender'],
                'address' => $row['address'] ?? null,
                'phone'   => $row['phone'] ?? null,
            ]
        );
    }

    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:255'],
            'dob'    => ['required', 'date'],
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'phone'  => ['nullable', 'string', 'max:30'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'name.required'   => 'Patient name is required.',
            'dob.required'    => 'Date of birth is required.',
            'dob.date'        => 'Invalid date format for date of birth.',
            'gender.required' => 'Gender must be Male, Female, or Other.',
        ];
    }
}
