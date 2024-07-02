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
            'name' => 'Yudi Pratama',
            'email' => 'yudi.pratama@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110007',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '1',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user1->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user1->id,
            'koordinator_id' => 1,
        ]);


        $user2 = User::create([
            'name' => 'Nina Amalia',
            'email' => 'nina.amalia@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110008',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '2',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user2->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user2->id,
            'koordinator_id' => 1,
        ]);


        $user3 = User::create([
            'name' => 'Dedi Permana',
            'email' => 'dedi.permana@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110009',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '3',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user3->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user3->id,
            'koordinator_id' => 2,
        ]);


        $user4 = User::create([
            'name' => 'Tuti Wulandari',
            'email' => 'tuti.wulandari@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110010',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '4',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user4->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user4->id,
            'koordinator_id' => 2,
        ]);


        $user5 = User::create([
            'name' => 'Beni Susanto',
            'email' => 'beni.susanto@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110011',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '1',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user5->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user5->id,
            'koordinator_id' => 3,
        ]);


        $user6 = User::create([
            'name' => 'Laila Rahmawati',
            'email' => 'laila.rahmawati@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110012',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '2',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user6->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user6->id,
            'koordinator_id' => 3,
        ]);


        $user7 = User::create([
            'name' => 'Arif Santoso',
            'email' => 'arif.santoso@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110013',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '3',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user7->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user7->id,
            'koordinator_id' => 4,
        ]);


        $user8 = User::create([
            'name' => 'Mira Susanti',
            'email' => 'mira.susanti@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110014',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '4',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user8->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user8->id,
            'koordinator_id' => 4,
        ]);


        $user9 = User::create([
            'name' => 'Hendra Wijaya',
            'email' => 'hendra.wijaya@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110015',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '1',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user9->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user9->id,
            'koordinator_id' => 5,
        ]);


        $user10 = User::create([
            'name' => 'Desi Kartika',
            'email' => 'desi.kartika@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110016',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '2',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user10->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user10->id,
            'koordinator_id' => 5,
        ]);
        $user11 = User::create([
            'name' => 'Reza Pratama',
            'email' => 'reza.pratama@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110017',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '3',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user11->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user11->id,
            'koordinator_id' => 6,
        ]);

        $user12 = User::create([
            'name' => 'Tina Lestari',
            'email' => 'tina.lestari@gmail.com',
            'password' => Hash::make('password'),
            'telephone' => '082211110018',
            'role' => 'saksi',
        ]);

        Saksi::create([
            'tps' => '4',
            'jumlah_suara' => '0',
            'foto_kertas_suara' => 'kertas_suara_'  .$user12->id. '.jpg',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'user_id' => $user12->id,
            'koordinator_id' => 6,
        ]);


    }
}
