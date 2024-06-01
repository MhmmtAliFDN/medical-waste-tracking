<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctor = Role::findByName('doctor');
        $nurse = Role::findByName('nurse');
        $manager = Role::findByName('manager');
        $authorizedOfficer = Role::findByName('authorized officer');
        $wasteCollectionStaff = Role::findByName('waste collection staff');

        $d1 = User::where('id', 2)->first();
        $d2 = User::where('id', 3)->first();
        $d3 = User::where('id', 5)->first();

        $n1 = User::where('id', 1)->first();
        $n2 = User::where('id', 4)->first();

        $m1 = User::where('id', 6)->first();

        $ao1 = User::where('id', 7)->first();
        $ao2 = User::where('id', 8)->first();

        $wcs1 = User::where('id', 9)->first();
        $wcs2 = User::where('id', 10)->first();

        $d1->assignRole($doctor);
        $d2->assignRole($doctor);
        $d3->assignRole($doctor);

        $n1->assignRole($nurse);
        $n2->assignRole($nurse);

        $m1->assignRole($manager);

        $ao1->assignRole($authorizedOfficer);
        $ao2->assignRole($authorizedOfficer);

        $wcs1->assignRole($wasteCollectionStaff);
        $wcs2->assignRole($wasteCollectionStaff);
    }
}
