<?php
namespace App\Filament\Resources\PengaturanResource\Api\Handlers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PengaturanResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PengaturanResource::class;
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
            $model = static::getModel()::where('paslon_id',$id)->first();
            if (!$model) {
                $response = static::sendNotFoundResponse();
            } else {
                $validator = Validator::make($request->all(), [
                    'paslon_id' => 'sometimes|integer|unique:pengaturan,paslon_id,'.$model->id,
                    'target_suara' => 'sometimes|integer',
                ]);
                if ($validator->fails()) {
                    $response = static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
                } else {
                    $model->update([
                        'paslon_id' => $request->paslon_id ? $request->paslon_id : $model->paslon_id,
                        'target_suara' => $request->target_suara ? $request->target_suara : $model->target_suara,
                    ]);
                    $model = Pengaturan::find($model->id);
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
