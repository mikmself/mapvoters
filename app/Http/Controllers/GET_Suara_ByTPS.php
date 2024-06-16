<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GET_Suara_ByTPS extends Controller
{
    public function getDataTPS($id_paslon, $kelurahan_id)
    {
        $data = DB::table('saksi')
            ->join('koordinator', 'saksi.koordinator_id', '=', 'koordinator.id')
            ->join('paslon', 'koordinator.paslon_id', '=', 'paslon.id')
            ->where('paslon.id', $id_paslon)
            ->where('saksi.kelurahan_id', $kelurahan_id)
            ->select('saksi.tps', 'saksi.jumlah_suara', 'saksi.foto_kertas_suara')
            ->get();

        return response()->json([
            'message' => 'Data TPS berhasil diambil',
            'data' => $data
        ]);
    }
}
