<?php
namespace App\Filament\Resources\KoordinatorResource\Api\Handlers;

use App\Models\Koordinator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KoordinatorResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = KoordinatorResource::class;

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
            $model = Koordinator::find($id);
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
                        $fotoPath = $this->prosesFoto($request, 'koordinator');
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
                        'nama' => $request->nama ? $request->nama : $model->nama,
                        'email' => $request->email ? $request->email : $model->email,
                        'telepon' => $request->telepon  ? $request->telepon : $model->telepon,
                        'foto' => $fotoPath,
                    ]);
                    $koordinator = Koordinator::with('user')->find($id);
                    DB::commit();
                    $response =  static::sendSuccessResponse($koordinator,"Successfully Updated Resource");
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $response =  static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
        return $response;
    }
}
