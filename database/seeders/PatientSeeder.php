<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example patient data
        $firstName = 'Chep';
        $lastName = 'Chan';
        $fullName = $firstName . ' ' . $lastName;
        
        // Use the Model to create the patient record
        Patient::create([
            'email' => 'chep@example.com',
            'first_name' => $firstName,
            'last_name' => $lastName,
            'full_name' => $fullName, // <-- This is where you add the full name
            'gender' => 'Male',
            'contact_number' => '091764646464',
        ]);
        
        // You can add more patient records here
        // Example:
        // Patient::create([
        //     'email' => 'maria.santos@example.com',
        //     'first_name' => 'Maria',
        //     'last_name' => 'Santos',
        //     'full_name' => 'Maria Santos',
        //     'gender' => 'Female',
        //     'contact_number' => '0917xxxxxxx',
        // ]);
    }
}