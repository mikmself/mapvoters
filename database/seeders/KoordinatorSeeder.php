<?php

namespace Database\Seeders;

use App\Models\Koordinator;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KoordinatorSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110001',
            'role' => 'koordinator',
        ]);
        Koordinator::create([
            'nik' => '333111000111001',
            'foto' => 'budi_santoso.jpg',
            'paslon_id' => 1,
            'user_id' => $user1->id,
        ]);

        $user2 = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110002',
            'role' => 'koordinator',
        ]);
        Koordinator::create([
            'nik' => '333111000111002',
            'foto' => 'siti_nurhaliza.jpg',
            'paslon_id' => 1,
            'user_id' => $user2->id,
        ]);

        $user3 = User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi.wijaya@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110003',
            'role' => 'koordinator',
        ]);
        Koordinator::create([
            'nik' => '333111000111003',
            'foto' => 'andi_wijaya.jpg',
            'paslon_id' => 2,
            'user_id' => $user3->id,
        ]);

        $user4 = User::create([
            'name' => 'Rina Kartika',
            'email' => 'rina.kartika@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110004',
            'role' => 'koordinator',
        ]);
        Koordinator::create([
            'nik' => '333111000111004',
            'foto' => 'rina_kartika.jpg',
            'paslon_id' => 2,
            'user_id' => $user4->id,
        ]);

        $user5 = User::create([
            'name' => 'Agus Pratama',
            'email' => 'agus.pratama@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110005',
            'role' => 'koordinator',
        ]);
        Koordinator::create([
            'nik' => '333111000111005',
            'foto' => 'agus_pratama.jpg',
            'paslon_id' => 3,
            'user_id' => $user5->id,
        ]);

        $user6 = User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi.lestari@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110006',
            'role' => 'koordinator',
        ]);
        Koordinator::create([
            'nik' => '333111000111006',
            'foto' => 'dewi_lestari.jpg',
            'paslon_id' => 3,
            'user_id' => $user6->id,
        ]);

    }
}
