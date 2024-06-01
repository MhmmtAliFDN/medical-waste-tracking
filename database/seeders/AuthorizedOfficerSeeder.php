<?php

namespace Database\Seeders;

use App\Models\AuthorizedOfficer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorizedOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AuthorizedOfficer::create([
            'id' => 1,
            'user_id' => 7,
            'updated_at' => null
        ]);

        AuthorizedOfficer::create([
            'id' => 2,
            'user_id' => 8,
            'updated_at' => null
        ]);
    }
}
