<?php

namespace App\Http\Controllers;

use App\Models\Saksi;
use Illuminate\Http\Request;

class SaksiController extends Controller
{
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
    public function create(Request $request)
    {
        // Validasi request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|string|max:15',
            'role' => 'required|string',
            // Validasi data saksi lainnya
            'koordinator_id' => 'required|integer',
            'some_other_field' => 'required|string'
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'role' => $request->role,
        ]);

        // Buat data saksi baru
        $saksi = Saksi::create([
            'user_id' => $user->id,
            'koordinator_id' => $request->koordinator_id,
            'some_other_field' => $request->some_other_field,
            // Tambahkan field lainnya sesuai kebutuhan
        ]);

        return response()->json([
            'message' => 'Data saksi berhasil dibuat',
            'data' => $saksi
        ], 201);
    }
}
