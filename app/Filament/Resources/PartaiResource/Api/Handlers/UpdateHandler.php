<?php
namespace App\Filament\Resources\PartaiResource\Api\Handlers;

use App\Models\Partai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PartaiResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PartaiResource::class;

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
            $model = Partai::find($id);
            if(!$model) {
                $response = static::sendNotFoundResponse();
            } else {
                if($request->hasFile('logo')) {
                    $logoPath = $this->prosesFoto($request, 'partai', 'logo');
                } else {
                    $logoPath = $model->logo;
                }
                $model->update([
                    'nama' => $request->nama ? $request->nama : $model->nama,
                    'nomor_urut' => $request->nomor_urut ? $request->nomor_urut : $model->nomor_urut,
                    'logo' => $logoPath,
                ]);
                $partai = Partai::with('paslon')->find($id);
                DB::commit();
                $response = static::sendSuccessResponse($partai);
            }
        }catch(\Exception $e) {
            DB::rollBack();
            $response = static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
        return $response;
    }
}
