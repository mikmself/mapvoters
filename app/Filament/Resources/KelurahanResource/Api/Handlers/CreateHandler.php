<?php
namespace App\Filament\Resources\KelurahanResource\Api\Handlers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KelurahanResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = KelurahanResource::class;

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
                'kecamatan_id' => 'required|integer|exists:kecamatan,id',
            ]);
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $newModel = Kelurahan::create([
                'nama' => $request->nama,
                'kecamatan_id' => $request->kecamatan_id,
            ]);
            $kelurahan = Kelurahan::where('id', $newModel->id)->first();
            DB::commit();
            return static::sendSuccessResponse($kelurahan, 'Successfully Create Resource');
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), 'Failed to Create Resource', 500);
        }
    }
}
