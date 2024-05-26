<?php

namespace Database\Seeders;

use App\Models\Saksi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SaksiSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Saksi 1',
            'email' => 'saksi1@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '081283928392',
            'role' => 'saksi'
        ]);
        Saksi::create([
            'tps' => '1',
            'jumlah_suara' => '100',
            'foto_kertas_suara' => 'kertas-suara1.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user1->id,
            'koordinator_id' => 1
        ]);

        $user2 = User::create([
            'name' => 'Saksi 2',
            'email' => 'saksi2@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082283023341',
            'role' => 'saksi'
        ]);
        Saksi::create([
            'tps' => '2',
            'jumlah_suara' => '200',
            'foto_kertas_suara' => 'kertas-suara2.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3301',
            'kecamatan_id' => '330101',
            'kelurahan_id' => '3301012003',
            'user_id' => $user2->id,
            'koordinator_id' => 1
        ]);
    }
}
