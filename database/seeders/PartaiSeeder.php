<?php

namespace Database\Seeders;

use App\Models\Partai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartaiSeeder extends Seeder
{
    public function run(): void
    {
        $partai = [
            [
                "nama" => "Gerindra",
                'nomor_urut' => 1,
                'logo' => 'gerindra.png'
            ],
            [
                "nama" => "PDI Perjuangan",
                'nomor_urut' => 2,
                'logo' => 'pdip.png'
            ],
            [
                "nama" => "Golkar",
                'nomor_urut' => 3,
                'logo' => 'golkar.png'
            ],
            [
                "nama" => "Nasdem",
                'nomor_urut' => 4,
                'logo' => 'nasdem.png'
            ],
            [
                "nama" => "PKB",
                'nomor_urut' => 5,
                'logo' => 'pkb.png'
            ],
            [
                "nama" => "Demokrat",
                'nomor_urut' => 6,
                'logo' => 'demokrat.png'
            ],
            [
                "nama" => "PKS",
                "nomor_urut" => 7,
                "logo" => "pks.png"
            ],
            [
                "nama" => "PAN",
                "nomor_urut" => 8,
                "logo" => "pan.png"
            ],
            [
                "nama" => "PPP",
                "nomor_urut" => 9,
                "logo" => "ppp.png"
            ],
            [
                "nama" => "Perindo",
                "nomor_urut" => 10,
                "logo" => "perindo.png"
            ],
            [
                "nama" => "Hanura",
                "nomor_urut" => 11,
                "logo" => "hanura.png"
            ],
            [
                "nama" => "Garuda",
                "nomor_urut" => 12,
                "logo" => "garuda.png"
            ],
            [
                "nama" => "Berkarya",
                "nomor_urut" => 13,
                "logo" => "berkarya.png"
            ],
            [
                "nama" => "PKPI",
                "nomor_urut" => 14,
                "logo" => "pkpi.png"
            ],
            [
                "nama" => "PSI",
                "nomor_urut" => 15,
                "logo" => "psi.png"
            ],
            [
                "nama" => "PBB",
                "nomor_urut" => 16,
                "logo" => "pbb.png"
            ],
            [
                "nama" => "PAN",
                "nomor_urut" => 17,
                "logo" => "pan.png"
            ],
            [
                "nama" => "PKPI",
                "nomor_urut" => 18,
                "logo" => "pkpi.png"
            ],
            [
                "nama" => "PSI",
                "nomor_urut" => 19,
                "logo" => "psi.png"
            ],
            [
                "nama" => "PBB",
                "nomor_urut" => 20,
                "logo" => "pbb.png"
            ],
            [
                "nama" => "PAN",
                "nomor_urut" => 21,
                "logo" => "pan.png"
            ],
            [
                "nama" => "PKPI",
                "nomor_urut" => 22,
                "logo" => "pkpi.png"
            ],
        ];
        foreach ($partai as $p) {
            Partai::create($p);
        }
    }
}
