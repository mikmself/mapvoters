<?php
namespace App\Filament\Resources\PemilihPotensialResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PemilihPotensialResource;
use Illuminate\Routing\Router;


class PemilihPotensialApiService extends ApiService
{
    protected static string | null $resource = PemilihPotensialResource::class;

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
