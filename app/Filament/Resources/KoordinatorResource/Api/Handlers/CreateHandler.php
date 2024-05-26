<?php
namespace App\Filament\Resources\KoordinatorResource\Api\Handlers;

use App\Models\Koordinator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\KoordinatorResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = KoordinatorResource::class;

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
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'telephone' => 'required|numeric|unique:users,telephone',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nik' => 'required',
                'paslon_id' => 'required',
            ]);
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telephone' => $request->telephone,
                'role' => 'koordinator'
            ]);
            $newModel = Koordinator::create([
                'foto' => $this->prosesFoto($request,'koordinator'),
                'nik' => $request->nik,
                'paslon_id' => $request->paslon_id,
                'user_id' => $user->id
            ]);
            $koordinator = Koordinator::where('id', $newModel->id)->with('user')->first();
            DB::commit();
            return static::sendSuccessResponse($koordinator, 'Successfully Create Resource');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
    }
}
