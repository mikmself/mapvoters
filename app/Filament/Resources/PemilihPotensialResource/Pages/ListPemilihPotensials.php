<?php

namespace App\Filament\Resources\PemilihPotensialResource\Pages;

use App\Filament\Resources\PemilihPotensialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemilihPotensials extends ListRecords
{
    protected static string $resource = PemilihPotensialResource::class;
    protected ?string $heading = 'Pemilih Potensial';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
