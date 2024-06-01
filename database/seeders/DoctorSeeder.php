<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::create([
            'user_id' => 2,
            'registry_number' => 1024,
            'specialization' => 'Göz Hastalıkları',
            'updated_at' => null,
        ]);
        Doctor::create([
            'user_id' => 3,
            'registry_number' => 850,
            'specialization' => 'Kalp Hastalıkları',
            'updated_at' => null,
        ]);
        Doctor::create([
            'user_id' => 5,
            'registry_number' => 472,
            'specialization' => 'Cilt Hastalıkları',
            'updated_at' => null,
        ]);
    }
}
