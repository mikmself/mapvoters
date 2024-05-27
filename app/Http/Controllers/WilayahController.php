<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Paslon;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function pemetaanProvinsi($idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
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

        return response()->json([
            'message' => 'Data provinsi pemilih potensial paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $provinsi
        ]);
    }

    public function pemetaanKabupaten($idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
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

        return response()->json([
            'message' => 'Data kabupaten pemilih potensial paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $kabupaten
        ]);
    }

    public function pemetaanKecamatan($idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
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

        return response()->json([
            'message' => 'Data kecamatan pemilih potensial paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $kecamatan
        ]);
    }

    public function pemetaanKelurahan($idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
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

        return response()->json([
            'message' => 'Data kelurahan pemilih potensial paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $kelurahan
        ]);
    }
    public function getProvinsi()
    {
        $provinsi = Provinsi::all();
        return response()->json([
            'message' => 'Data provinsi berhasil diambil',
            'data' => $provinsi
        ]);
    }
    public function getKabupaten($idProvinsi)
    {
        $kabupaten = Kabupaten::where('provinsi_id', $idProvinsi)->get();
        return response()->json([
            'message' => 'Data kabupaten berhasil diambil',
            'data' => $kabupaten
        ]);
    }
    public function getKecamatan($idKabupaten)
    {
        $kecamatan = Kecamatan::where('kabupaten_id', $idKabupaten)->get();
        return response()->json([
            'message' => 'Data kecamatan berhasil diambil',
            'data' => $kecamatan
        ]);
    }
    public function getKelurahan($idKecamatan)
    {
        $kelurahan = Kelurahan::where('kecamatan_id', $idKecamatan)->get();
        return response()->json([
            'message' => 'Data kelurahan berhasil diambil',
            'data' => $kelurahan
        ]);
    }

}
