<?php
namespace App\Filament\Resources\PaslonResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PaslonResource;
use Illuminate\Routing\Router;


class PaslonApiService extends ApiService
{
    protected static string | null $resource = PaslonResource::class;

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
