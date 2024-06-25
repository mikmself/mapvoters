<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Paslon;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class PemetaanSuaraController extends Controller
{
    public function pemetaanSuaraProvinsi($idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        if (!$paslon) {
            return response()->json(['error' => 'DATA MASIH KOSONG'], 404);
        }

        $provinsi = Provinsi::whereHas('pemilihPotensial', function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        })->withCount(['pemilihPotensial' => function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        }])->get()->filter(function ($provinsi) {
            return $provinsi->pemilih_potensial_count > 0;
        });

        return response()->json($provinsi);
    }

    public function pemetaanSuaraKabupaten($idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        if (!$paslon) {
            return response()->json(['error' => 'DATA MASIH KOSONG'], 404);
        }

        $kabupaten = Kabupaten::whereHas('pemilihPotensial', function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        })->withCount(['pemilihPotensial' => function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        }])->get()->filter(function ($kabupaten) {
            return $kabupaten->pemilih_potensial_count > 0;
        });

        return response()->json($kabupaten);
    }

    public function pemetaanSuaraKecamatan($idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        if (!$paslon) {
            return response()->json(['error' => 'DATA MASIH KOSONG'], 404);
        }

        $kecamatan = Kecamatan::whereHas('pemilihPotensial', function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        })->withCount(['pemilihPotensial' => function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        }])->get()->filter(function ($kecamatan) {
            return $kecamatan->pemilih_potensial_count > 0;
        });

        return response()->json($kecamatan);
    }

    public function pemetaanSuaraKelurahan($idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        if (!$paslon) {
            return response()->json(['error' => 'DATA MASIH KOSONG'], 404);
        }

        $kelurahan = Kelurahan::whereHas('pemilihPotensial', function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        })->withCount(['pemilihPotensial' => function ($query) use ($idPaslon) {
            $query->whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            });
        }])->get()->filter(function ($kelurahan) {
            return $kelurahan->pemilih_potensial_count > 0;
        });

        return response()->json($kelurahan);
    }
}
