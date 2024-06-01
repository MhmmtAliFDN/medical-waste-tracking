<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DoctorSeeder::class,
            NurseSeeder::class,
            ManagerSeeder::class,
            AuthorizedOfficerSeeder::class,
            WasteCollectionStaffSeeder::class,
            MedicalWasteSeeder::class,
            ReportSeeder::class,
            RoleSeeder::class,
            ModelHasRolesSeeder::class,
        ]);
    }
}
