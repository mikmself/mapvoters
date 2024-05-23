<?php

namespace App\Filament\Resources\KoordinatorResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\KoordinatorResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = KoordinatorResource::class;

    public static bool $public = true;

    public function handler(Request $request)
    {
        try {
            $id = $request->route('id');
            $query = static::getEloquentQuery();
            $query = $query->with('user')->where(static::getKeyName(), $id)->firstOrFail();
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
