<?php
namespace App\Filament\Resources\PengaturanResource\Api\Handlers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PengaturanResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PengaturanResource::class;
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
                'paslon_id' => 'required|numeric|unique:pengaturan,paslon_id',
                'target_suara' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $newModel = Pengaturan::create([
                'paslon_id' => $request->paslon_id,
                'target_suara' => $request->target_suara,
            ]);
            $pengaturan = Pengaturan::where('id', $newModel->id)->first();
            DB::commit();
            return static::sendSuccessResponse($pengaturan, 'Successfully Create Resource');
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
    }
}
