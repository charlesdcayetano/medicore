<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        Patient::firstOrCreate(['email'=>'juan.delacruz@example.com'],[
          'first_name'=>'Juan','last_name'=>'Dela Cruz','gender'=>'Male','contact_number'=>'0917xxxxxxx'
        ]);
    }
}
