<?php

namespace App\Filament\Resources\KecamatanResource\Pages;

use App\Filament\Resources\KecamatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKecamatans extends ListRecords
{
    protected static string $resource = KecamatanResource::class;
    protected ?string $heading = 'Kecamatan';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
