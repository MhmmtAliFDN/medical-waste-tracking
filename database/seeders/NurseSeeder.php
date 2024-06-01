<?php

namespace Database\Seeders;

use App\Models\Nurse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nurse::create([
            'user_id' => 1,
            'registry_number' => 514,
            'department' => 'Acil',
            'updated_at' => null,
        ]);
        Nurse::create([
            'user_id' => 4,
            'registry_number' => 217,
            'department' => 'Ameliyathane',
            'updated_at' => null,
        ]);
    }
}
