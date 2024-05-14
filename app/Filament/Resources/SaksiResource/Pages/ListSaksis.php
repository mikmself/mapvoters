<?php

namespace App\Filament\Resources\SaksiResource\Pages;

use App\Filament\Resources\SaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSaksis extends ListRecords
{
    protected static string $resource = SaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
