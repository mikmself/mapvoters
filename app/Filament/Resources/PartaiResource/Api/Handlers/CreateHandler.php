<?php
namespace App\Filament\Resources\PartaiResource\Api\Handlers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PartaiResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PartaiResource::class;

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
                'nama' => 'required',
                'nomor_urut' => 'required|numeric',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $newModel = static::getModel()::create([
                'nama' => $request->nama,
                'nomor_urut' => $request->nomor_urut,
                'logo' => $this->prosesFoto($request,'partai','logo')
            ]);
            $partai = static::getModel()::where('id', $newModel->id)->first();
            DB::commit();
            return static::sendSuccessResponse($partai, 'Successfully Create Resource');
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
    }
}
