<?php

namespace App\Filament\Resources\PartaiResource\Pages;

use App\Filament\Resources\PartaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPartais extends ListRecords
{
    protected static string $resource = PartaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
