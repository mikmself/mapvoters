<?php
namespace App\Filament\Resources\ProvinsiResource\Api\Handlers;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ProvinsiResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = ProvinsiResource::class;

    public static bool $public = true;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    public function handler(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->route('id');
            $model = Provinsi::find($id);
            if (!$model) {
                $response = static::sendNotFoundResponse();
            } else {
                $validator = Validator::make($request->all(), [
                    'id' => 'sometimes|int|unique:provinsi,id',
                    'nama' => 'sometimes|string',
                ]);
                if ($validator->fails()) {
                    $response = static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
                } else {
                    $model->update([
                        'id' => $request->id ? $request->id : $model->id,
                        'nama' => $request->nama ? $request->nama : $model->nama,
                    ]);
                    $provinsi = Provinsi::find($model->id);
                    DB::commit();
                    $response = static::sendSuccessResponse($provinsi,"Successfully Updated Resource");
                }
            }
        }
        catch (\Exception $e) {
            DB::rollBack();
            $response = static::sendErrorResponse($e->getMessage(), "Failed to Update Resource", 500);
        }
        return $response;
    }
}
