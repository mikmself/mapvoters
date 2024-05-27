<?php
namespace App\Filament\Resources\KabupatenResource\Api\Handlers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KabupatenResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = KabupatenResource::class;

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
                    'nama' => 'sometimes|string',
                    'provinsi_id' => 'sometimes|exists:provinsi,id|integer',
                ]);
                if ($validator->fails()) {
                    $response = static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
                } else {
                    $model->update([
                        'nama' => $request->nama ? $request->nama : $model->nama,
                        'provinsi_id' => $request->provinsi_id ? $request->provinsi_id : $model->provinsi_id,
                    ]);
                    $model = User::find($model->id);
                    DB::commit();
                    $response = static::sendSuccessResponse($model,"Successfully Updated Resource");
                }
            }
        }catch (\Exception $e) {
            DB::rollBack();
            $response = static::sendErrorResponse($e->getMessage(), "Failed to Update Resource", 500);
        }
        return $response;
    }
}
