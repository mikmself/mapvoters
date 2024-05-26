<?php

namespace App\Filament\Resources\SaksiResource\Pages;

use App\Filament\Resources\SaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSaksi extends EditRecord
{
    protected static string $resource = SaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
