<?php

namespace Database\Seeders;

use App\Models\PemilihPotensial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemilihPotensialSeeder extends Seeder
{
    public function run(): void
    {
        for($i = 1; $i <= 10; $i++) {
            PemilihPotensial::create([
                'nama' => 'Pemilih Potensial ' . $i,
                'nik' => '123456789012345' . $i,
                'foto_ktp' => 'ktp' . $i . '.jpg',
                'telephone' => '08128392839'.$i,
                'tps' => '1',
                'provinsi_id' => '33',
                'kabupaten_id' => '3302',
                'kecamatan_id' => '330225',
                'kelurahan_id' => '3302251002',
                'koordinator_id' => 1
            ]);
        }
        for($i = 11; $i <= 20; $i++) {
            PemilihPotensial::create([
                'nama' => 'Pemilih Potensial ' . $i,
                'nik' => '123456789012345' . $i,
                'foto_ktp' => 'ktp' . $i . '.jpg',
                'telephone' => '08128392839'.$i,
                'tps' => '2',
                'provinsi_id' => '33',
                'kabupaten_id' => '3301',
                'kecamatan_id' => '330101',
                'kelurahan_id' => '3301012003',
                'koordinator_id' => 1
            ]);
        }
    }
}
