<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use App\Models\Paslon;
use App\Models\Saksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ], 422);
            }
            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'The provided credentials do not match our records.'
                ], 401);
            }
            $user = Auth::user();
            $token = Str::random(60);
            $user->setRememberToken($token);
            $user->save();
            $paslon = Paslon::where('user_id', $user->id)->first();
            $koordinator = Koordinator::where('user_id', $user->id)->first();
            $saksi = Saksi::where('user_id', $user->id)->first();
            $logindata = null;
            if ($saksi) {
                $logindata = $saksi;
            } elseif ($koordinator) {
                $logindata = $koordinator;
            } elseif ($paslon) {
                $logindata = $paslon;
            }
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'data' => [
                    'user' => $user,
                    'logindata' => $logindata,
                    // 'koordinator' => $koordinator,
                    'token' => $token
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during login',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'type' => 'required',
                'nomor_urut' => 'required',
                'dapil' => 'required',
                'partai_id' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'telephone' => 'required|numeric|unique:users,telephone',
            ]);
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telephone' => $request->telephone,
                'role' => 'paslon'
            ]);
            $newModel = Paslon::create([
                'foto' => $this->prosesFoto($request, 'paslon'),
                'type' => $request->type,
                'nomor_urut' => $request->nomor_urut,
                'dapil' => $request->dapil,
                'partai_id' => $request->partai_id,
                'user_id' => $user->id
            ]);
            $paslon = Paslon::where('id', $newModel->id)->with('user')->first();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Successfully Create Resource',
                'data' => $paslon
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            $user = Auth::user();
            $user->setRememberToken(null);
            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'Logout successful'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during logout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
