<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        $er = Department::firstOrCreate(['code'=>'ER'], ['name'=>'Emergency']);
        $opd = Department::firstOrCreate(['code'=>'OPD'], ['name'=>'Outpatient']);

        User::firstOrCreate(['email'=>'admin@medicore.local'], [
            'name'=>'System Admin',
            'password'=>Hash::make('password'),
            'role'=>'Admin',
            'department_id'=>$er->id,
        ]);

        User::firstOrCreate(['email'=>'dr.chep@medicore.local'], [
            'name'=>'Dr. Santos',
            'password'=>Hash::make('password'),
            'role'=>'Doctor',
            'department_id'=>$opd->id,
        ]);

        User::firstOrCreate(['email'=>'staff@medicore.local'], [
            'name'=>'Hospital Staff',
            'password'=>Hash::make('password'),
            'role'=>'Staff',
            'department_id'=>$opd->id,
        ]);
    }
}
