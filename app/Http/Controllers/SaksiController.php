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
     /**
     * Show untuk menampilkan data.
     */
    public function show($id)
    {
        $paslon = Paslon::find($id);
        $saksi = Saksi::whereHas('koordinator', function ($query) use ($id) {
            $query->where('paslon_id', $id);
        })->get();

        return response()->json([
            'message' => 'Data Saksi ' . $paslon->user->name . ' berhasil diambil',
            'data' => $saksi,
        ]);
    }
    
    /**
     * Update untuk mengedit saksi.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tps' => 'sometimes|string|max:255',
            'provinsi_id' => 'sometimes|exists:provinsi,id',
            'kabupaten_id' => 'sometimes|exists:kabupaten,id',
            'kecamatan_id' => 'sometimes|exists:kecamatan,id',
            'kelurahan_id' => 'sometimes|exists:kelurahan,id',
            'name' => 'sometimes',
            'telephone' => 'sometimes',
        ]);
        DB::beginTransaction();
        $saksi = Saksi::find($id);
        if (!$saksi) {
            return response()->json(['message' => 'Saksi not found'], Response::HTTP_NOT_FOUND);
        }
        
        $saksi->update([
            'tps' => $request->input('tps'),
            'provinsi_id' => $request->input('provinsi_id'),
            'kabupaten_id' => $request->input('kabupaten_id'),
            'kecamatan_id' => $request->input('kecamatan_id'),
            'kelurahan_id' => $request->input('kelurahan_id'),
        ]);
        $user = User::find($saksi->user_id);
        $user->update([
            'name' => $request->input('name'),
            'telephone' => $request->input('telephone'),
        ]);
        return response()->json([
            'saksi' => $saksi,
            'user' => $user
        ], Response::HTTP_OK);
    }
    
    /**
     * Delete untuk menghapus saksi.
     */
    public function delete($id)
    {
        $saksi = Saksi::find($id);
        if (!$saksi) {
            return response()->json(['message' => 'Saksi not found'], Response::HTTP_NOT_FOUND);
        }

        $saksi->delete();
        return response()->json(['message' => 'Saksi deleted successfully'], Response::HTTP_OK);
    }
}