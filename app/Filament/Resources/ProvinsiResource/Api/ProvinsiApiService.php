<?php
namespace App\Filament\Resources\ProvinsiResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ProvinsiResource;
use Illuminate\Routing\Router;


class ProvinsiApiService extends ApiService
{
    protected static string | null $resource = ProvinsiResource::class;

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
