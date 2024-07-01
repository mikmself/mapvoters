<?php

namespace App\Http\Controllers;

use App\Models\Saksi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class SaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index($paslonId)
    // {
    //     $koordinator = Koordinator
    //     if (isset($paslonId)) {
    //         $saksi = Saksi::where('paslon_id', $paslonId)->get();
    //     } else {
    //         $saksi = Saksi::all();
    //     }
    //     return response()->json($saksi, Response::HTTP_OK);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'tps' => 'required|string|max:255',
        //     'provinsi_id' => 'required|exists:provinsi,id',
        //     'kabupaten_id' => 'required|exists:kabupaten,id',
        //     'kecamatan_id' => 'required|exists:kecamatan,id',
        //     'kelurahan_id' => 'required|exists:kelurahan,id',
        //     'user_id' => 'required|exists:users,id',
        //     'koordinator_id' => 'required|exists:koordinator,id',
        //     'paslon_id' => 'required|exists:paslon,id',
        // ]);

        // $saksi = Saksi::create($request->only([
        //     'tps',
        //     'provinsi_id',
        //     'kabupaten_id',
        //     'kecamatan_id',
        //     'kelurahan_id',
        //     'user_id',
        //     'koordinator_id',
        //     'paslon_id',
        // ]));
        // return response()->json($saksi, Response::HTTP_CREATED);
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
     * Display the specified resource.
     */
    public function show($id)
    {
        $saksi = Saksi::find($id);
        if (!$saksi) {
            return response()->json(['message' => 'Saksi not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($saksi, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tps' => 'required|string|max:255',
            'provinsi_id' => 'required|exists:provinsi,id',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kelurahan_id' => 'required|exists:kelurahan,id',
            'user_id' => 'required|exists:users,id',
            'koordinator_id' => 'required|exists:koordinator,id',
            // 'paslon_id' => 'required|exists:paslon,id',
        ]);

        $saksi = Saksi::find($id);
        if (!$saksi) {
            return response()->json(['message' => 'Saksi not found'], Response::HTTP_NOT_FOUND);
        }

        $saksi->update($request->only([
            'tps',
            'provinsi_id',
            'kabupaten_id',
            'kecamatan_id',
            'kelurahan_id',
            'user_id',
            'koordinator_id',
            // 'paslon_id',
        ]));
        return response()->json($saksi, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
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

    public function search(Request $request)
    {
        $saksi = Saksi::with('koordinator','user')->whereHas('user', function ($query) use ($request) {
            $query->where('name', $request->name);
        })->first();

        if ($saksi) {
            return response()->json([
                'message' => 'Data saksi ditemukan',
                'data' => $saksi
            ]);
        } else {
            return response()->json([
                'message' => 'Data saksi tidak ditemukan',
                'data' => []
            ], 404);
        }
    }
}
