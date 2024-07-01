<?php

namespace App\Filament\Resources\PaslonResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PaslonResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
            $query = static::getEloquentQuery();
            $query = $query->with('user','partai')->where(static::getKeyName(), $id)->firstOrFail();
            if (!$query) {
                return static::sendNotFoundResponse();
            }
            $transformer = static::getApiTransformer();
            return new $transformer($query);
        } catch (ModelNotFoundException $exception) {
            return static::sendNotFoundResponse($exception->getMessage());
        }
    }
}
