<?php
namespace App\Filament\Resources\SaksiResource\Api\Handlers;

use App\Models\Saksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\SaksiResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = SaksiResource::class;

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
        $response = null;
        try {
            DB::beginTransaction();
            $id = $request->route('id');
            $model = Saksi::find($id);
            if (!$model) {
                $response = static::sendNotFoundResponse();
            } else {
                $validator = Validator::make($request->all(), [
                    'foto_kertas_suara' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'password' => 'sometimes',
                ]);
                if ($validator->fails()) {
                    $response = static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
                } else {
                    $user = User::find($model->user_id);
                    if ($request->hasFile('foto_kertas_suara')) {
                        if ($model->foto_kertas_suara) {
                            Storage::delete('public/' . $model->foto_kertas_suara);
                        }
                        $fotoPath = $this->prosesFoto($request, 'saksi');
                    } else {
                        $fotoPath = $model->foto_kertas_suara;
                    }
                    $user->update([
                        'name' => $request->name ? $request->name : $user->name,
                        'email' => $request->email ? $request->email : $user->email,
                        'telephone' => $request->telephone  ? $request->telephone : $user->telephone,
                        'password' => $request->password ? Hash::make($request->password) : $user->password,
                    ]);
                    $model->update([
                        'tps' => $request->tps ? $request->tps : $model->tps,
                        'jumlah_suara' => $request->jumlah_suara ? $request->jumlah_suara : $model->jumlah_suara,
                        'foto_kertas_suara' => $fotoPath,
                        'provinsi_id' => $request->provinsi_id ? $request->provinsi_id : $model->provinsi_id,
                        'kabupaten_id' => $request->kabupaten_id ? $request->kabupaten_id : $model->kabupaten_id,
                        'kecamatan_id' => $request->kecamatan_id ? $request->kecamatan_id : $model->kecamatan_id,
                        'kelurahan_id' => $request->kelurahan_id ? $request->kelurahan_id : $model->kelurahan_id,
                        'user_id' => $request->user_id ? $request->user_id : $model->user_id,
                        'koordinator_id' => $request->koordinator_id ? $request->koordinator_id : $model->koordinator_id,
                    ]);
                    $saksi = Saksi::with('provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'user', 'koordinator')->find($model->id);
                    DB::commit();
                    $response = static::sendSuccessResponse($saksi, "Successfully Updated Resource");
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $response = static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
        return $response;
    }
}
