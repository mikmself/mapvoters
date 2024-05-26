<?php
namespace App\Filament\Resources\PaslonResource\Api\Handlers;

use App\Models\Paslon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PaslonResource;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PaslonResource::class;

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
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'type' => 'required',
                'nomor_urut' => 'required',
                'dapil' => 'required',
                'partai_id' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'telephone' => 'required|numeric|unique:users,telephone',
            ]);
            if ($validator->fails()) {
                return static::sendErrorResponse($validator->errors(), $validator->errors(), 422);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telephone' => $request->telephone,
                'role' => 'paslon'
            ]);
            $newModel = Paslon::create([
                'foto' => $this->prosesFoto($request,'paslon'),
                'type' => $request->type,
                'nomor_urut' => $request->nomor_urut,
                'dapil' => $request->dapil,
                'partai_id' => $request->partai_id,
                'user_id' => $user->id
            ]);
            $paslon = Paslon::where('id', $newModel->id)->with('user')->first();
            DB::commit();
            return static::sendSuccessResponse($paslon, "Successfully Create Resource");
        }catch (\Exception $e) {
            DB::rollBack();
            return static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }
    }
}
