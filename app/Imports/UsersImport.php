<?php

namespace App\Imports;

use App\Models\Patient;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Convert Excel date if numeric
        $dob = is_numeric($row['dob'])
            ? Date::excelToDateTimeObject($row['dob'])->format('Y-m-d')
            : $row['dob'];

        // Prevent duplicates (check by name + dob)
        return Patient::updateOrCreate(
            [
                'name' => trim($row['name']),
                'dob'  => $dob,
            ],
            [
                'gender'  => ucfirst(strtolower($row['gender'])), // Normalize
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
            'dob.date'        => 'Date of birth must be a valid date.',
            'gender.required' => 'Gender must be Male, Female, or Other.',
        ];
    }
}
