<?php

namespace App\Http\Controllers;

use App\Models\PemilihPotensial;
use App\Models\Paslon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PemilihPotensialController extends Controller
{

    public function index()
    {
        $pemilihPotensial = PemilihPotensial::all();
        return response()->json([
            'code' => 1,
            'message' => 'semua data pemilih potensial',
            'data' => $pemilihPotensial
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nik' => 'required|unique:pemilih_potensial',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'telephone' => 'required|unique:pemilih_potensial',
            'tps' => 'required',
            'provinsi_id' => 'required',
            'kabupaten_id' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            'koordinator_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'message' => 'Data pemilih gagal disimpan',
                'errors' => $validator->errors()->all()
            ], 400);
        }

        try {
            // Simpan foto_ktp
            if ($request->hasFile('foto_ktp')) {
                $fotoKtp = $request->file('foto_ktp');
                $namaFoto = 'KTP '.$request->input('nama').'.'.$fotoKtp->getClientOriginalExtension();
                $fotoKtp->move(public_path('KTP'), $namaFoto);
            }

            // Buat dan simpan data pemilih potensial
            $pemilihPotensial = PemilihPotensial::create([
                'nama' => $request->input('nama'),
                'nik' => $request->input('nik'),
                'foto_ktp' => isset($namaFoto) ? $namaFoto : null, // Simpan nama file foto jika ada
                'telephone' => $request->input('telephone'),
                'tps' => $request->input('tps'),
                'provinsi_id' => $request->input('provinsi_id'),
                'kabupaten_id' => $request->input('kabupaten_id'),
                'kecamatan_id' => $request->input('kecamatan_id'),
                'kelurahan_id' => $request->input('kelurahan_id'),
                'koordinator_id' => $request->input('koordinator_id'),
            ]);

            return response()->json(['data' => $pemilihPotensial], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'message' => 'Terjadi kesalahan saat menyimpan data pemilih',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAllData($idPaslon)
    {
        $paslon = Paslon::find($idPaslon);
        $pemilih = PemilihPotensial::whereHas('koordinator', function ($query) use ($idPaslon) {
            $query->where('paslon_id', $idPaslon);
        })->get();

        return response()->json([
            'message' => 'Data Saksi by provinsi  paslon ' . $paslon->user->name . ' berhasil diambil',
            'data' => $pemilih,

        ]);
    }


    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $pemilih=PemilihPotensial::where('id', $id)->first();
            if (!isset($pemilih)) {
                return response()->json([
                    'code' => 0,
                    'message' => 'data tidak ada',
                    'data' => []
                ]);
            }

            $validatedData = Validator::make($request->all(),[
                'nama' => 'required',
                'nik' => 'required',
                'foto_ktp' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'telephone' => 'required',
                'tps' => 'required',
                'provinsi_id' => 'required',
                'kabupaten_id' => 'required',
                'kecamatan_id' => 'required',
                'kelurahan_id' => 'required',
                'koordinator_id' => 'required',
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'code' => 0,
                    'message' => $validatedData->errors(),
                    'data' => []
                ]);
            }
            if ($request->hasFile('foto_ktp')) {
                $foto = $request->file('foto_ktp');
                $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('path/to/foto_ktp'), $namaFoto);
            }

           $pemilih->update(
            [
                'nama' => $request->input('nama'),
                'nik' => $request->input('nik'),
                'foto_ktp' => $namaFoto,
                'telephone' => $request->input('telephone'),
                'tps' => $request->input('tps'),
                'provinsi_id' => $request->input('provinsi_id'),
                'kabupaten_id' => $request->input('kabupaten_id'),
                'kecamatan_id' => $request->input('kecamatan_id'),
                'kelurahan_id' => $request->input('kelurahan_id'),
                'koordinator_id' => $request->input('koordinator_id'),
            ]
            );
            DB::commit();

            return response()->json(['data' => $pemilih]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'message' => 'Gagal memperbarui data',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }


    public function destroy(PemilihPotensial $pemilihPotensial)
    {
        $pemilihPotensial->delete();

        return response()->json(['message' => 'Pemilih potensial berhasil dihapus']);
    }
}
