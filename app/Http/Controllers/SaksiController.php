<?php

namespace App\Http\Controllers;

use App\Models\Saksi;
use App\Models\User;
use App\Models\Paslon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class SaksiController extends Controller
{
    /**
     * Store untuk create saksi.
     */
    public function store(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [
                'tps' => 'required',
                'provinsi_id' => 'required',
                'kabupaten_id' => 'required',
                'kecamatan_id' => 'required',
                'kelurahan_id' => 'required',
                'koordinator_id' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'telephone' => 'required|numeric|unique:users,telephone',
        ]);
        if($validator->fails()){
            return response()->json([
                'code' => 0,
                'message' => 'data saksi gagal disimpan',
                'data' => $validator->errors()
            ]);
        }
        
        DB::beginTransaction();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'role' => 'saksi'
        ]);
            $saksi = Saksi::create([
                'tps' => $request->tps,
                'jumlah_suara' => '0' ,
                'foto_kertas_suara' =>'foto.jpg',
                'provinsi_id' => $request->provinsi_id,
                'kabupaten_id' => $request->kabupaten_id,
                'kecamatan_id' => $request->kecamatan_id,
                'kelurahan_id' => $request->kelurahan_id,
                'koordinator_id' => $request->koordinator_id,
                'user_id' => $user->id
            ]);
            DB::commit();
            return response()->json([
                'code' => 1,
                'message' => 'data saksi berhasil disimpan',
                'data' => $saksi
            ]);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'code' => 0,
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }
}