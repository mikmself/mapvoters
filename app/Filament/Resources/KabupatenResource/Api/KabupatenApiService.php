<?php
namespace App\Filament\Resources\KabupatenResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KabupatenResource;
use Illuminate\Routing\Router;


class KabupatenApiService extends ApiService
{
    protected static string | null $resource = KabupatenResource::class;

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
