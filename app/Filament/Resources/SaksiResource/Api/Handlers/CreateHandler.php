<?php
namespace App\Filament\Resources\SaksiResource\Api\Handlers;

use App\Models\Saksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\SaksiResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = SaksiResource::class;

    public static bool $public = true;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    public function handler(Request $request)
    {
        try {
            DB::beginTransaction();
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
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telephone' => $request->telephone,
                'role' => 'saksi'
            ]);
            $newModel = Saksi::create([
                'tps' => $request->tps,
                'jumlah_suara' => $request->jumlah_suara,
                'foto_kertas_suara' => $request->foto_kertas_suara != null ? $this->prosesFoto($request,'foto_kertas_suara') : null,
                'provinsi_id' => $request->provinsi_id,
                'kabupaten_id' => $request->kabupaten_id,
                'kecamatan_id' => $request->kecamatan_id,
                'kelurahan_id' => $request->kelurahan_id,
                'koordinator_id' => $request->koordinator_id,
                'user_id' => $user->id
            ]);
            $saksi = Saksi::where('id', $newModel->id)->with('provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'user', 'koordinator')->first();
            DB::commit();
            return static::sendSuccessResponse($saksi, 'Successfully Create Resource');
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
    }
}
