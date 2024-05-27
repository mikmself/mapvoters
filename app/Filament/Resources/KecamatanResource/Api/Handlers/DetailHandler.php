<?php

namespace App\Filament\Resources\KecamatanResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\KecamatanResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = KecamatanResource::class;

    public static bool $public = true;

    public function handler(Request $request)
    {
        try {
            $id = $request->route('id');
            $query = QueryBuilder::for(static::getEloquentQuery());
            $query = $query->with('kabupaten','kelurahan','saksi','pemilihPotensial')->where(static::getKeyName(), $id)->firstOrFail();
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
