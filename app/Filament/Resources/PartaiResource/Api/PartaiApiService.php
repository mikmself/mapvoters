<?php
namespace App\Filament\Resources\PartaiResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PartaiResource;
use Illuminate\Routing\Router;


class PartaiApiService extends ApiService
{
    protected static string | null $resource = PartaiResource::class;

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
