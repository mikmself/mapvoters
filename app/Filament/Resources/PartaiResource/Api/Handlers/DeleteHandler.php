<?php
namespace App\Filament\Resources\PartaiResource\Api\Handlers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PartaiResource;

class DeleteHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PartaiResource::class;

    public static bool $public = true;

    public static function getMethod()
    {
        return Handlers::DELETE;
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
            if (!$model) return static::sendNotFoundResponse();
            if ($model->logo) {
                Storage::delete('public/' . $model->logo);
            }
            $model->delete();
            DB::commit();
            return static::sendSuccessResponse(["partai" => $model], "Successfully Delete Resource");
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
    }
}
