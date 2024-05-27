<?php
namespace App\Filament\Resources\KecamatanResource\Api\Handlers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KecamatanResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = KecamatanResource::class;

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
        try{
            DB::beginTransaction();
            $id = $request->route('id');
            $model = static::getModel()::find($id);
            if (!$model) {
                $response = static::sendNotFoundResponse();
            } else {
                $validator = Validator::make($request->all(), [
                    'nama' => 'sometimes|string',
                    'kabupaten_id' => 'sometimes|exists:kabupaten,id|integer',
                ]);
                if ($validator->fails()) {
                    $response = static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
                } else {
                    $model->update([
                        'nama' => $request->nama ? $request->nama : $model->nama,
                        'kabupaten_id' => $request->kabupaten_id ? $request->kabupaten_id : $model->kabupaten_id,
                    ]);
                    $model = Kecamatan::find($model->id);
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
