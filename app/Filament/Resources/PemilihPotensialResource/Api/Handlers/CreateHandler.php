<?php
namespace App\Filament\Resources\PemilihPotensialResource\Api\Handlers;

use App\Models\PemilihPotensial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PemilihPotensialResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PemilihPotensialResource::class;

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
                'nama' => 'required',
                'nik' => 'required',
                'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'telephone' => 'required|numeric',
                'tps' => 'required',
                'provinsi_id' => 'required',
                'kabupaten_id' => 'required',
                'kecamatan_id' => 'required',
                'kelurahan_id' => 'required',
                'koordinator_id' => 'required',
            ]);
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $newModel = static::getModel()::create([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'foto_ktp' => $this->prosesFoto($request,'foto_ktp','foto_ktp'),
                'telephone' => $request->telephone,
                'tps' => $request->tps,
                'provinsi_id' => $request->provinsi_id,
                'kabupaten_id' => $request->kabupaten_id,
                'kecamatan_id' => $request->kecamatan_id,
                'kelurahan_id' => $request->kelurahan_id,
                'koordinator_id' => $request->koordinator_id,
            ]);
            $pemilihPotensial = PemilihPotensial::where('id', $newModel->id)->with('provinsi')->with('kabupaten')->with('kecamatan')->with('kelurahan')->with('koordinator')->first();
            DB::commit();
            return static::sendSuccessResponse($pemilihPotensial, 'Successfully Create Resource');
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
    }
}
