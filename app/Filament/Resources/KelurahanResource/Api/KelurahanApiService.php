<?php
namespace App\Filament\Resources\KelurahanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KelurahanResource;
use Illuminate\Routing\Router;


class KelurahanApiService extends ApiService
{
    protected static string | null $resource = KelurahanResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
