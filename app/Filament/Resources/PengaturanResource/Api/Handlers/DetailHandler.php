<?php

namespace App\Filament\Resources\PengaturanResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\PengaturanResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PengaturanResource::class;
    public static bool $public = true;

    public function handler(Request $request)
    {
        try {
            $id = $request->route('id');
            $query = static::getEloquentQuery();
            $query = QueryBuilder::for(
                $query->where('paslon_id', $id)
            )->first();
            if (!$query) return static::sendNotFoundResponse();
            $transformer = static::getApiTransformer();
            return new $transformer($query);
        }catch (ModelNotFoundException $exception) {
            return static::sendNotFoundResponse($exception->getMessage());
        }
    }
}
