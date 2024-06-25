<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Paslon;
use App\Models\Provinsi;
use App\Models\Saksi;
use Illuminate\Http\Request;

class PemetaanC1Controller extends Controller
{
    public function C1Provinsi($idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        $provinsi = Provinsi::whereHas('saksi', function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        })->withCount(['saksi' => function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        }])->get()->filter(function ($provinsi) {
            return $provinsi->saksi_count > 0;
        });

        return response()->json([
            'message' => 'Data C1 by provinsi  paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $provinsi
        ]);
    }

    public function C1Kabupaten($idProvinsi, $idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        $kabupaten = Kabupaten::whereHas('provinsi', function ($query) use ($idProvinsi) {
            $query->where('provinsi_id', $idProvinsi);
        })->whereHas('saksi', function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        })->withCount(['saksi' => function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        }])->get()->filter(function ($kabupaten) {
            return $kabupaten->saksi_count > 0;
        });

        return response()->json([
            'message' => 'Data C1 by kabupaten  paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $kabupaten
        ]);
    }

    public function C1Kecamatan($idKabupaten, $idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        $kecamatan = Kecamatan::whereHas('kabupaten', function ($query) use ($idKabupaten) {
            $query->where('kabupaten_id', $idKabupaten);
        })->whereHas('saksi', function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        })->withCount(['saksi' => function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        }])->get()->filter(function ($kecamatan) {
            return $kecamatan->saksi_count > 0;
        });

        return response()->json([
            'message' => 'Data C1 by Kecamatan  paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $kecamatan
        ]);
    }

    public function C1Kelurahan($idKecamatan, $idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        $kelurahan = Kelurahan::whereHas('kecamatan', function ($query) use ($idKecamatan) {
            $query->where('kecamatan_id', $idKecamatan);
        })->whereHas('saksi', function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        })->withCount(['saksi' => function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        }])->get()->filter(function ($kelurahan) {
            return $kelurahan->saksi_count > 0;
        });

        return response()->json([
            'message' => 'Data C1 by Kelurahan  paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $kelurahan
        ]);
    }
}
