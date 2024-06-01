<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Meltem Nacar',
            'email' => 'hemsire1@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 2,
            'name' => 'Asım Tilki',
            'email' => 'doktor1@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 3,
            'name' => 'Dilek Tiryaki',
            'email' => 'doktor2@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 4,
            'name' => 'Gülizar Avcı',
            'email' => 'hemsire2@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 5,
            'name' => 'Mesut Gazi',
            'email' => 'doktor3@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 6,
            'name' => 'Onur Kırıcı',
            'email' => 'yonetici1@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 7,
            'name' => 'Deniz Işık',
            'email' => 'yetkilimemur1@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 8,
            'name' => 'Alex Fidan',
            'email' => 'yetkilimemur2@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 9,
            'name' => 'Fıstık Fidan',
            'email' => 'atiktoplamapersoneli1@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 10,
            'name' => 'Egemen Batum',
            'email' => 'atiktoplamapersoneli2@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 11,
            'name' => 'Alev Kırmızı',
            'email' => 'user1@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 12,
            'name' => 'Hülya Tekin',
            'email' => 'user2@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 13,
            'name' => 'Ahmet Erkan',
            'email' => 'user3@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
        User::create([
            'id' => 14,
            'name' => 'Fatih Düzen',
            'email' => 'user4@memur.com',
            'password' => Hash::make('password'),
            'updated_at' => null,
        ]);
    }
}
