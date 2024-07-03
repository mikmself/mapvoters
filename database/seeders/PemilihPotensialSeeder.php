<?php

namespace Database\Seeders;

use App\Models\PemilihPotensial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemilihPotensialSeeder extends Seeder
{
    public function run(): void
    {
        PemilihPotensial::create([
            'nama' => 'Ahmad Firdaus',
            'nik' => '333111000111013',
            'foto_ktp' => 'ktp_ahmad_firdaus.jpg',
            'telephone' => '082211110019',
            'tps' => '1',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '1'
        ]);

        PemilihPotensial::create([
            'nama' => 'Fitriani Sari',
            'nik' => '333111000111014',
            'foto_ktp' => 'ktp_fitriani_sari.jpg',
            'telephone' => '082211110020',
            'tps' => '2',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '1'
        ]);

        PemilihPotensial::create([
            'nama' => 'Rizki Ramadhan',
            'nik' => '333111000111015',
            'foto_ktp' => 'ktp_rizki_ramadhan.jpg',
            'telephone' => '082211110021',
            'tps' => '1',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '2'
        ]);

        PemilihPotensial::create([
            'nama' => 'Maya Indah',
            'nik' => '333111000111016',
            'foto_ktp' => 'ktp_maya_indah.jpg',
            'telephone' => '082211110022',
            'tps' => '2',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '2'
        ]);

        PemilihPotensial::create([
            'nama' => 'Dika Pratama',
            'nik' => '333111000111017',
            'foto_ktp' => 'ktp_dika_pratama.jpg',
            'telephone' => '082211110023',
            'tps' => '1',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '3'
        ]);

        PemilihPotensial::create([
            'nama' => 'Rini Septiani',
            'nik' => '333111000111018',
            'foto_ktp' => 'ktp_rini_septiani.jpg',
            'telephone' => '082211110024',
            'tps' => '2',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '3'
        ]);

        PemilihPotensial::create([
            'nama' => 'Irfan Maulana',
            'nik' => '333111000111019',
            'foto_ktp' => 'ktp_irfan_maulana.jpg',
            'telephone' => '082211110025',
            'tps' => '1',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '4'
        ]);

        PemilihPotensial::create([
            'nama' => 'Siska Putri',
            'nik' => '333111000111020',
            'foto_ktp' => 'ktp_siska_putri.jpg',
            'telephone' => '082211110026',
            'tps' => '2',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '4'
        ]);

        PemilihPotensial::create([
            'nama' => 'Dodi Saputra',
            'nik' => '333111000111021',
            'foto_ktp' => 'ktp_dodi_saputra.jpg',
            'telephone' => '082211110027',
            'tps' => '1',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '5'
        ]);

        PemilihPotensial::create([
            'nama' => 'Nisa Fitriani',
            'nik' => '333111000111022',
            'foto_ktp' => 'ktp_nisa_fitriani.jpg',
            'telephone' => '082211110028',
            'tps' => '2',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '5'
        ]);

        PemilihPotensial::create([
            'nama' => 'Farhan Akbar',
            'nik' => '333111000111023',
            'foto_ktp' => 'ktp_farhan_akbar.jpg',
            'telephone' => '082211110029',
            'tps' => '1',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '6'
        ]);

        PemilihPotensial::create([
            'nama' => 'Anisa Rahmawati',
            'nik' => '333111000111024',
            'foto_ktp' => 'ktp_anisa_rahmawati.jpg',
            'telephone' => '082211110030',
            'tps' => '2',
            'provinsi_id' => '33',
            'kabupaten_id' => '3302',
            'kecamatan_id' => '330225',
            'kelurahan_id' => '3302251002',
            'koordinator_id' => '6'
        ]);

    }
}
