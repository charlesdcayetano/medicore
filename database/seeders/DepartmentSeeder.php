<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = ['Cardiology', 'Pediatrics', 'Emergency'];

foreach ($departments as $dept) {
    Department::updateOrCreate(['name' => $dept]);
}}
};
