<?php

namespace App\Http\Controllers;

use App\Models\Saksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadC1Controller extends Controller
{
    public function UploadC1($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $saksi = Saksi::where('id', $id)->first();
            if (!isset($saksi)) {
                return response()->json([
                    'code' => 0,
                    'message' => 'data tidak ada',
                    'data' => []
                ]);
            }
            $validator = Validator::make($request->all(), [
                'jumlah_suara' => 'required|numeric',
                'foto_kertas_suara' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => 0,
                    'message' => $validator->errors(),
                    'data' => []
                ]);
            }
            $foto = $request->file('foto_kertas_suara');
            if ($foto) {
                $namaFoto = 'kertas-suara' .$saksi->id .'.'. $foto->getClientOriginalExtension();
                if ($saksi->foto_kertas_suara) {
                    Storage::delete('public/c1/' . $saksi->foto_kertas_suara);
                }
                $foto->move(public_path('c1'), $namaFoto);
                $saksi->update([
                    'foto_kertas_suara' => $namaFoto
                ]);
            }
            $saksi->update([
                'jumlah_suara' => $request->input('jumlah_suara'),
            ]);
            DB::commit();
            return response()->json([
               'code' => 1,
               'message' => 'data berhasil di update',
               'data' => $saksi
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json([
                'code' => 0,
                'message' => $exception->getMessage(),
                'data' => []
            ]);
        }
    }
}
