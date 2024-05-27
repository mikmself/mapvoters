<?php
namespace App\Filament\Resources\KelurahanResource\Api\Handlers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KelurahanResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = KelurahanResource::class;

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
            $model = static::getModel()::find($id);
            if (!$model) {
                $response = static::sendNotFoundResponse();
            } else {
                $validator = Validator::make($request->all(), [
                    'id' => 'sometimes|integer|unique:kelurahan,id,'.$model->id,
                    'nama' => 'sometimes|string',
                    'kecamatan_id' => 'sometimes|integer|exists:kecamatan,id',
                ]);
                if ($validator->fails()) {
                    $response = static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
                } else {
                    $model->update([
                        'id' => $request->id ? $request->id : $model->id,
                        'nama' => $request->nama ? $request->nama : $model->nama,
                        'kecamatan_id' => $request->kecamatan_id ? $request->kecamatan_id : $model->kecamatan_id,
                    ]);
                    $model = Kelurahan::find($model->id);
                    DB::commit();
                    $response = static::sendSuccessResponse($model, "Successfully Updated Resource");
                }
            }
        }catch (\Exception $e) {
            DB::rollBack();
            $response = static::sendErrorResponse($e->getMessage(), "Failed to Update Resource", 500);
        }
        return $response;
    }
}
