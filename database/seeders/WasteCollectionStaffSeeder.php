<?php

namespace Database\Seeders;

use App\Models\WasteCollectionStaff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WasteCollectionStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WasteCollectionStaff::create([
            'id' => 1,
            'user_id' => 9,
            'shift' => "8-12",
            'updated_at' => null,
        ]);

        WasteCollectionStaff::create([
            'id' => 2,
            'user_id' => 10,
            'shift' => "15-22",
            'updated_at' => null,
        ]);
    }
}
