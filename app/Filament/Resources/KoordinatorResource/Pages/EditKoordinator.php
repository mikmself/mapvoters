<?php

namespace App\Filament\Resources\KoordinatorResource\Pages;

use App\Filament\Resources\KoordinatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKoordinator extends EditRecord
{
    protected static string $resource = KoordinatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
