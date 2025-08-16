<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
          ['name'=>'Emergency','code'=>'ER'],
          ['name'=>'Cardiology','code'=>'CARD'],
          ['name'=>'Pediatrics','code'=>'PEDS'],
          ['name'=>'General Surgery','code'=>'SURG'],
        ];
        foreach ($data as $d) {
          Department::firstOrCreate(['code'=>$d['code']], $d);
        }
    }
}
