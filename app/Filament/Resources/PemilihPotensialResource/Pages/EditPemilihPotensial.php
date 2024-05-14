<?php

namespace App\Filament\Resources\PemilihPotensialResource\Pages;

use App\Filament\Resources\PemilihPotensialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemilihPotensial extends EditRecord
{
    protected static string $resource = PemilihPotensialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
