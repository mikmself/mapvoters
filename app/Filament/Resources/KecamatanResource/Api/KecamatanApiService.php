<?php
namespace App\Filament\Resources\KecamatanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KecamatanResource;
use Illuminate\Routing\Router;


class KecamatanApiService extends ApiService
{
    protected static string | null $resource = KecamatanResource::class;

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
