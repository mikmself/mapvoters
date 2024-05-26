<?php
namespace App\Filament\Resources\ProvinsiResource\Api\Handlers;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ProvinsiResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = ProvinsiResource::class;

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
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $newModel = static::getModel()::create([
                'name' => $request->name,
            ]);
            $provinsi = Provinsi::where('id', $newModel->id)->first();
            DB::commit();
            return static::sendSuccessResponse($provinsi, 'Successfully Create Resource');
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), 'Failed to Create Resource', 500);
        }
    }
}
