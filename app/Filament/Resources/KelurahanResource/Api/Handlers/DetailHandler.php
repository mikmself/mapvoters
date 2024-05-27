<?php

namespace App\Filament\Resources\KelurahanResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\KelurahanResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = KelurahanResource::class;

    public static bool $public = true;

    public function handler(Request $request)
    {
        try {
            $id = $request->route('id');
            $query = QueryBuilder::for(static::getEloquentQuery());
            $query = $query->with('kecamatan','saksi','pemilihPotensial')->where(static::getKeyName(), $id)->firstOrFail();
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
