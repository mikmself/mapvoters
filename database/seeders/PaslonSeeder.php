<?php

namespace Database\Seeders;

use App\Models\Paslon;
use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PaslonSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Ir. Subani Charis Prasetya, S.Kom',
            'email' => 'subani@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211113333',
            'role' => 'paslon'
        ]);
        $paslon1 = Paslon::create([
            'foto' => 'subani.jpg',
            'type' => 'dprri',
            'nomor_urut' => 1,
            'dapil' => 'Jawa Tengah VIII',
            'partai_id' => 1,
            'user_id' => $user1->id
        ]);
        Pengaturan::create([
            'paslon_id'=> $paslon1->id,
            'target_suara'=>0
        ]);

        $user2 = User::create([
            'name' => 'Jefri Hardiawan, M.Kom',
            'email' => 'jefri@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '085811112222',
            'role' => 'paslon'
        ]);
        $paslon2 = Paslon::create([
            'foto' => 'jefri.jpg',
            'type' => 'dprri',
            'nomor_urut' =>2,
            'dapil' => 'Jawa Tengah VIII',
            'partai_id' => 1,
            'user_id' => $user2->id
        ]);
        Pengaturan::create([
            'paslon_id'=> $paslon2->id,
            'target_suara'=>0
        ]);

        $user3 = User::create([
            'name' => 'Rafli Amirudin',
            'email' => 'rafli@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '089811113333',
            'role' => 'paslon'
        ]);
        $paslon3 = Paslon::create([
            'foto' => 'rafli.jpg',
            'type' => 'dprri',
            'nomor_urut' => 3,
            'dapil' => 'Jawa Tengah VIII',
            'partai_id' => 1,
            'user_id' => $user3->id
        ]);
        Pengaturan::create([
            'paslon_id'=> $paslon3->id,
            'target_suara'=>0
        ]);
    }
}
