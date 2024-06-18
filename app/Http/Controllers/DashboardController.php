<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use App\Models\PemilihPotensial;
use App\Models\Pengaturan;
use App\Models\Saksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboardData($idPaslon){
        try {
            $targetSuara = Pengaturan::where('paslon_id', $idPaslon)->first()->target_suara;
            $toalKoordinator = Koordinator::where('paslon_id', $idPaslon)->count();
            $totalSaksi = Saksi::whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            })->count();
            $totalSuaraPotensial = PemilihPotensial::whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            })->count();
            $perhitunganSuaraReal = Saksi::whereHas('koordinator', function ($query) use ($idPaslon) {
                $query->where('paslon_id', $idPaslon);
            })->sum('jumlah_suara');
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diambil',
                'data' => [
                    'target_suara' => $targetSuara,
                    'total_koordinator' => $toalKoordinator,
                    'total_saksi' => $totalSaksi,
                    'total_suara_potensial' => $totalSuaraPotensial,
                    'perhitungan_suara_real' => $perhitunganSuaraReal
                ]
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
    }
}
