<?php

namespace App\Filament\Resources\PaslonResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PaslonResource;
use App\Models\User;
use Rupadana\ApiService\Http\Handlers;
use Illuminate\Http\Request;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PaslonResource::class;

    public static bool $public = true;



    public function handler(Request $request)
    {
        try {
            $id = $request->route('id');
            $model = static::getModel()::find($id);
            if (!$model) return static::sendNotFoundResponse();
            $user = User::where('id',$model->user_id)->first();
            return static::sendSuccessResponse(["paslon" => $model, "user" => $user], "Successfully Show Detail Resource");
        }catch (\Exception $e) {
            return static::sendErrorResponse($e->getMessage(), $e->getMessage(), 500);
        }

    }
}
