<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    public function search(Request $request)
    {
        $koordinator = Koordinator::with('paslon','user')->whereHas('user', function ($query) use ($request) {
            $query->where('name', $request->name);
        })->first();

        if ($koordinator) {
            return response()->json([
                'message' => 'Data koordinator ditemukan',
                'data' => $koordinator
            ]);
        } else {
            return response()->json([
                'message' => 'Data koordinator tidak ditemukan',
                'data' => []
            ], 404);
        }
    }
}
