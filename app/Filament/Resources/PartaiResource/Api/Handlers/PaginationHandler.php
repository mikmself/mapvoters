<?php
namespace App\Filament\Resources\PartaiResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\PartaiResource;

class PaginationHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PartaiResource::class;

    public static bool $public = true;

    public function handler()
    {
        $query = static::getEloquentQuery();
        $model = static::getModel();

        $query = QueryBuilder::for($query)
        ->allowedFields($model::$allowedFields ?? [])
        ->allowedSorts($model::$allowedSorts ?? [])
        ->allowedFilters($model::$allowedFilters ?? [])
        ->allowedIncludes($model::$allowedIncludes ?? null)
            ->with('paslon')
        ->paginate(request()->query('per_page'))
        ->appends(request()->query());

        return static::getApiTransformer()::collection($query);
    }
}
