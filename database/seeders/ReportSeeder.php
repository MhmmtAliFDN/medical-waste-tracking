<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Report::create([
            'id' => 1,
            'authorized_officer_id' => 1,
            'title' => 'Mayıs Ayı Son Hafta Raporu',
            'content' => 'pdf\reports\7-gunluk-rapor-b247b682-03b5-4aaf-886b-d5500e4741bc.pdf',
            'updated_at' => null,
        ]);
        Report::create([
            'id' => 2,
            'authorized_officer_id' => 2,
            'title' => 'Mayıs Ayı Raporu',
            'content' => 'pdf\reports\31-gunluk-rapor-a5fcd553-b321-4176-ab2c-9874819da9b2.pdf',
            'updated_at' => null,
        ]);
    }
}
