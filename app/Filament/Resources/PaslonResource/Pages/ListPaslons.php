<?php

namespace App\Filament\Resources\PaslonResource\Pages;

use App\Filament\Resources\PaslonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaslons extends ListRecords
{
    protected static string $resource = PaslonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
