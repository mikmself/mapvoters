<?php
namespace App\Filament\Resources\PaslonResource\Api\Handlers;

use App\Models\Paslon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PaslonResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PaslonResource::class;

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
            $model = Paslon::find($id);
            if (!$model) {
                $response = static::sendNotFoundResponse();
            } else {
                $validator = Validator::make($request->all(), [
                    'foto' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'password' => 'sometimes',
                ]);
                if ($validator->fails()) {
                    $response = static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
                } else {
                    $user = User::find($model->user_id);
                    if ($request->hasFile('foto')) {
                        if ($model->foto) {
                            Storage::delete('public/' . $model->foto);
                        }
                        $fotoPath = $this->prosesFoto($request, 'paslon');
                    } else {
                        $fotoPath = $model->foto;
                    }
                    $user->update([
                        'name' => $request->name ? $request->name : $user->name,
                        'email' => $request->email ? $request->email : $user->email,
                        'telephone' => $request->telephone  ? $request->telephone : $user->telephone,
                        'password' => $request->password ? Hash::make($request->password) : $user->password,
                    ]);
                    $model->update([
                        'foto' => $fotoPath,
                        'type' => $request->type ? $request->type : $model->type,
                        'nomor_urut' => $request->nomor_urut ? $request->nomor_urut : $model->nomor_urut,
                        'dapil' => $request->dapil ? $request->dapil : $model->dapil,
                        'partai_id' => $request->partai_id ? $request->partai_id : $model->partai_id,
                    ]);
                    $paslon = Paslon::with('user')->find($id);
                    DB::commit();
                    $response = static::sendSuccessResponse($paslon, "Successfully Updated Resource");
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $response = static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }

        return $response;
    }
}
