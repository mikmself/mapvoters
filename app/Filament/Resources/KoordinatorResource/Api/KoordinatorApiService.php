<?php
namespace App\Filament\Resources\KoordinatorResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KoordinatorResource;
use Illuminate\Routing\Router;


class KoordinatorApiService extends ApiService
{
    protected static string | null $resource = KoordinatorResource::class;

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
