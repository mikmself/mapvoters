<?php
namespace App\Filament\Resources\PemilihPotensialResource\Api\Handlers;

use App\Models\PemilihPotensial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PemilihPotensialResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PemilihPotensialResource::class;

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
            $model = PemilihPotensial::find($id);
            if (!$model){
                $response = static::sendNotFoundResponse();
            }else{
                $validator = Validator::make($request->all(), [
                    'foto_ktp' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                if ($validator->fails()) {
                    $response = static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
                }else{
                    if ($request->hasFile('foto_ktp')) {
                        if ($model->foto_ktp) {
                            Storage::delete('public/' . $model->foto_ktp);
                        }
                        $fotoPath = $this->prosesFoto($request, 'foto_ktp', 'foto_ktp');
                    } else {
                        $fotoPath = $model->foto_ktp;
                    }
                    $model->update([
                        'nama' => $request->nama ? $request->nama : $model->nama,
                        'nik' => $request->nik ? $request->nik : $model->nik,
                        'foto_ktp' => $fotoPath,
                        'telephone' => $request->telephone ? $request->telephone : $model->telephone,
                        'tps' => $request->tps ? $request->tps : $model->tps,
                        'provinsi_id' => $request->provinsi_id ? $request->provinsi_id : $model->provinsi_id,
                        'kabupaten_id' => $request->kabupaten_id ? $request->kabupaten_id : $model->kabupaten_id,
                        'kecamatan_id' => $request->kecamatan_id ? $request->kecamatan_id : $model->kecamatan_id,
                        'kelurahan_id' => $request->kelurahan_id ? $request->kelurahan_id : $model->kelurahan_id,
                        'koordinator_id' => $request->koordinator_id ? $request->koordinator_id : $model->koordinator_id,
                    ]);
                    $pemilihPotensial = PemilihPotensial::with('provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'koordinator')->find($model->id);
                    DB::commit();
                    $response = static::sendSuccessResponse($pemilihPotensial);
                }
            }
        }catch (\Exception $e){
            DB::rollBack();
            $response = static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
        return $response;
    }
}
