<?php
namespace App\Filament\Resources\KabupatenResource\Api\Handlers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KabupatenResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = KabupatenResource::class;

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
                'provinsi_id' => 'required',
            ]);
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $newModel = Kabupaten::create([
                'nama' => $request->name,
                'provinsi_id' => $request->provinsi_id,
            ]);
            $kabupaten = Kabupaten::where('id', $newModel->id)->first();
            DB::commit();
            return static::sendSuccessResponse($kabupaten, 'Successfully Create Resource');
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), 'Failed to Create Resource', 500);
        }
    }
}
