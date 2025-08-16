<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $er = Department::where('code','ER')->first();

        User::updateOrCreate(
          ['email'=>'admin@medicore.local'],
          ['name'=>'System Admin','password'=>Hash::make('password'),'role'=>'Admin']
        );
        User::updateOrCreate(
          ['email'=>'dr.chep@medicore.local'],
          ['name'=>'Dr. Chep','password'=>Hash::make('password'),'role'=>'Doctor','department_id'=>$er?->id]
        );
        User::updateOrCreate(
          ['email'=>'staff@medicore.local'],
          ['name'=>'Front Desk','password'=>Hash::make('password'),'role'=>'Staff','department_id'=>$er?->id]
        );
    }
}
