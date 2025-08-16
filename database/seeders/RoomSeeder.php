<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['ER-01','ER-02','ICU-01','W-101','W-102'] as $num) {
            Room::firstOrCreate(['number'=>$num], [
              'type'=> str_contains($num,'ICU')?'ICU':(str_contains($num,'ER')?'ER':'Ward'),
              'is_available'=>true
            ]);
        }
    }
}
