<?php
namespace App\Filament\Resources\KecamatanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\KecamatanResource;

class PaginationHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = KecamatanResource::class;

    public static bool $public = true;

    public function handler()
    {
        $query = static::getEloquentQuery();
        $model = static::getModel();

        $query = QueryBuilder::for($query)
        ->allowedFields($model::$allowedFields ?? [])
        ->allowedSorts($model::$allowedSorts ?? [])
        ->allowedFilters($model::$allowedFilters ?? [])
            ->with('kabupaten', 'kelurahan', 'saksi','pemilihPotensial')
        ->allowedIncludes($model::$allowedIncludes ?? null)
        ->paginate(request()->query('per_page'))
        ->appends(request()->query());

        return static::getApiTransformer()::collection($query);
    }
}
