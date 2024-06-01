<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\MedicalWaste;
use App\Models\Nurse;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalWasteSeeder extends Seeder
{
    public function run(): void
    {
        $doctor1 = Doctor::where('id', 1)->first();
        $doctor2 = Doctor::where('id', 2)->first();
        $doctor3 = Doctor::where('id', 3)->first();

        $nurse1 = Nurse::where('id', 1)->first();
        $nurse2 = Nurse::where('id', 2)->first();

        $medicalWaste1 = new MedicalWaste([
            'waste_type' => 'Gazli Bez',
            'waste_quantity' => 5,
            'status' => 'Toplanmadı',
            'created_at' => Carbon::createFromFormat('Y-m-d', '2024-05-30'),
            'updated_at' => null,
        ]);
        $medicalWaste2 = new MedicalWaste([
            'waste_type' => 'Siringa',
            'waste_quantity' => 10,
            'status' => 'Toplanmadı',
            'created_at' => Carbon::createFromFormat('Y-m-d', '2024-05-10'),
            'updated_at' => null,
        ]);

        $medicalWaste3 = new MedicalWaste([
            'waste_type' => 'Tup',
            'waste_quantity' => 4,
            'status' => 'Toplanmadı',
            'created_at' => Carbon::createFromFormat('Y-m-d', '2024-05-12'),
            'updated_at' => null,
        ]);
        $medicalWaste4 = new MedicalWaste([
            'waste_type' => 'Pecete',
            'waste_quantity' => 8,
            'status' => 'Toplandı',
            'created_at' => Carbon::createFromFormat('Y-m-d', '2024-05-10'),
            'updated_at' => null,
        ]);

        $medicalWaste5 = new MedicalWaste([
            'waste_type' => 'Gazli Bez',
            'waste_quantity' => 7,
            'status' => 'Toplandı',
            'created_at' => Carbon::createFromFormat('Y-m-d', '2024-05-17'),
            'updated_at' => null,
        ]);
        $medicalWaste6 = new MedicalWaste([
            'waste_type' => 'Siringa',
            'waste_quantity' => 10,
            'status' => 'Toplanmadı',
            'created_at' => Carbon::createFromFormat('Y-m-d', '2024-05-28'),
            'updated_at' => null,
        ]);

        $medicalWaste7 = new MedicalWaste([
            'waste_type' => 'Jilet',
            'waste_quantity' => 14,
            'status' => 'Toplandı',
            'created_at' => Carbon::createFromFormat('Y-m-d', '2024-05-02'),
            'updated_at' => null,
        ]);
        $medicalWaste8 = new MedicalWaste([
            'waste_type' => 'Kutu',
            'waste_quantity' => 2,
            'status' => 'Toplanmadı',
            'created_at' => Carbon::createFromFormat('Y-m-d', '2024-05-14'),
            'updated_at' => null,
        ]);

        $medicalWaste9 = new MedicalWaste([
            'waste_type' => 'Eldiven',
            'waste_quantity' => 15,
            'status' => 'Toplandı',
            'created_at' => Carbon::createFromFormat('Y-m-d', '2024-05-06'),
            'updated_at' => null,
        ]);
        $medicalWaste10 = new MedicalWaste([
            'waste_type' => 'Eldiven',
            'waste_quantity' => 6,
            'status' => 'Toplanmadı',
            'created_at' => Carbon::createFromFormat('Y-m-d', '2024-05-08'),
            'updated_at' => null,
        ]);


        $doctor1->medicalWastes()->save($medicalWaste1);
        $nurse1->medicalWastes()->save($medicalWaste2);
        $doctor2->medicalWastes()->save($medicalWaste3);
        $nurse2->medicalWastes()->save($medicalWaste4);
        $doctor3->medicalWastes()->save($medicalWaste5);
        $nurse1->medicalWastes()->save($medicalWaste6);
        $doctor1->medicalWastes()->save($medicalWaste7);
        $nurse2->medicalWastes()->save($medicalWaste8);
        $doctor2->medicalWastes()->save($medicalWaste9);
        $nurse1->medicalWastes()->save($medicalWaste10);
    }
}
