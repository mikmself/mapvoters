<?php
namespace App\Filament\Resources\SaksiResource\Api\Handlers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\SaksiResource;

class DeleteHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = SaksiResource::class;

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
            $user = User::where('id',$model->user_id)->first();
            if ($model->foto_kertas_suara != null) {
                Storage::delete('public/' . $model->foto_kertas_suara);
            }
            $model->delete();
            $user->delete();
            DB::commit();
            return static::sendSuccessResponse(["saksi" => $model, "user" => $user], "Successfully Delete Resource");
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
    }
}
