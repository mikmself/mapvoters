<?php
namespace App\Filament\Resources\PengaturanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PengaturanResource;
use Illuminate\Routing\Router;


class PengaturanApiService extends ApiService
{
    protected static string | null $resource = PengaturanResource::class;


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
