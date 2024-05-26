<?php
namespace App\Filament\Resources\UserResource\Api\Handlers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\UserResource;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = UserResource::class;

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
            $model = User::find($id);
            if (!$model) {
                $response = static::sendNotFoundResponse();
            } else {
                $validator = Validator::make($request->all(), [
                    'name' => 'sometimes|string',
                    'email' => 'sometimes|email',
                    'telephone' => 'sometimes|string',
                    'password' => 'sometimes|string',
                ]);
                if ($validator->fails()) {
                    $response = static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
                } else {
                    $model->update([
                        'name' => $request->name ? $request->name : $model->name,
                        'email' => $request->email ? $request->email : $model->email,
                        'telephone' => $request->telephone  ? $request->telephone : $model->telephone,
                        'password' => $request->password ? Hash::make($request->password) : $model->password,
                    ]);
                    $user = User::find($model->id);
                    DB::commit();
                    $response = static::sendSuccessResponse($user,"Successfully Updated Resource");
                }
            }
        }catch (\Exception $e) {
            DB::rollBack();
            $response = static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
        return $response;
    }
}
