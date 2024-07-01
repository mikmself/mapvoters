<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Paslon;
use App\Models\Provinsi;
use App\Models\PemilihPotensial;
use Illuminate\Http\Request;

class PemetaanSuaraController extends Controller
{
    public function pemataanSuaraProvinsi($idPaslon)
    {
        try {
            $paslon = Paslon::find($idPaslon);
            if (!$paslon) {
                return response()->json([
                    'message' => 'Paslon tidak ditemukan'
                ], 404);
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

            return response()->json([
                'message' => 'Data pemataanSuara by provinsi paslon ' . $paslon->user->name . ' berhasil diambil',
                'data' => $provinsi
            ]);
        } catch (\Exception $e) {
            // Log error
            \Log::error('Error in pemataanSuaraProvinsi: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function pemataanSuaraKabupaten($idProvinsi, $idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        $kabupaten = Kabupaten::whereHas('provinsi', function ($query) use ($idProvinsi) {
            $query->where('provinsi_id', $idProvinsi);
        })->whereHas('pemilihPotensial', function ($query) use ($idPaslon) {
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
            'message' => 'Data pemataanSuara by kabupaten  paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $kabupaten
        ]);
    }

    public function pemataanSuaraKecamatan($idKabupaten, $idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        $kecamatan = Kecamatan::whereHas('kabupaten', function ($query) use ($idKabupaten) {
            $query->where('kabupaten_id', $idKabupaten);
        })->whereHas('pemilihPotensial', function ($query) use ($idPaslon) {
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
            'message' => 'Data pemataanSuara by Kecamatan  paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $kecamatan
        ]);
    }

    public function pemataanSuaraKelurahan($idKecamatan, $idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        $kelurahan = Kelurahan::whereHas('kecamatan', function ($query) use ($idKecamatan) {
            $query->where('kecamatan_id', $idKecamatan);
        })->whereHas('pemilihPotensial', function ($query) use ($idPaslon) {
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
            'message' => 'Data pemataanSuara by Kelurahan  paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $kelurahan
        ]);
    }
}
