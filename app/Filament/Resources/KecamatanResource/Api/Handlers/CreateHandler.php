<?php
namespace App\Filament\Resources\KecamatanResource\Api\Handlers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KecamatanResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = KecamatanResource::class;

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
            $validator = Validator::make($request->all(),[
                'nama' => 'required|string',
                'kabupaten_id' => 'required',
            ]);
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $newModel = Kecamatan::create([
                'nama' => $request->name,
                'kabupaten_id' => $request->kabupaten_id,
            ]);
            $kecamatan = Kecamatan::where('id', $newModel->id)->first();
            DB::commit();
            return static::sendSuccessResponse($kecamatan, 'Successfully Create Resource');
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), 'Failed to Create Resource', 500);
        }
    }
}
