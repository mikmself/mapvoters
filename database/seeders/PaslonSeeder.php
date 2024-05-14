<?php

namespace Database\Seeders;

use App\Models\Paslon;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PaslonSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'nama' => 'Subani Irga Angelina Alam Sinurat',
            'email' => 'siaas@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '081233033303',
            'role' => 'paslon'
        ]);
        Paslon::create([
            'foto' => 'siaas.jpg',
            'type' => 'dprri',
            'nomor_urut' => 1,
            'dapil' => 'Jawa Tengah VIII',
            'partai_id' => 1,
            'user_id' => $user->id
        ]);
    }
}
