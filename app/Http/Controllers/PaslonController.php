<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paslon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PaslonController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'type' => 'required',
                'nomor_urut' => 'required',
                'dapil' => 'required',
                'name' => 'required',
                'password' => 'required',
                'email' => 'required',
                'telephone' => 'required|numeric',
                'partai_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => 0,
                    'message' => $validator->errors(),
                ]);
            }
            $foto = $request->file('foto');
            $namafoto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('paslon'), $namafoto);
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->input('name'),
                'password' => Hash::make($request->password),
                'email' => $request->input('email'),
                'telephone' => $request->input('telephone'),
                'role' => 'paslon',
            ]);

            $paslon = Paslon::create([
                'foto' => $namafoto,
                'type' => $request->input('type'),
                'nomor_urut' => $request->input('nomor_urut'),
                'dapil' => $request->input('dapil'),
                'partai_id' => $request->input('partai_id'),
                'user_id' => $user->id
            ]);

            DB::commit();
            return response()->json([
                'code' => 1,
                'message' => 'Data Paslon Berhasil Disimpan',
                'data' => $paslon,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'code' => 0,
                'message' => $e->getMessage(),
                'data' => null
            ]);
        }
    }
}
