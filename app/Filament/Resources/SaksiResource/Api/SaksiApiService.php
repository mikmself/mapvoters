<?php
namespace App\Filament\Resources\SaksiResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\SaksiResource;
use Illuminate\Routing\Router;


class SaksiApiService extends ApiService
{
    protected static string | null $resource = SaksiResource::class;

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
