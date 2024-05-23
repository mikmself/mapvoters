<?php

namespace App\Filament\Resources\PartaiResource\Pages;

use App\Filament\Resources\PartaiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPartai extends EditRecord
{
    protected static string $resource = PartaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
