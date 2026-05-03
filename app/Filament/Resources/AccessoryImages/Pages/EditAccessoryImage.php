<?php

namespace App\Filament\Resources\AccessoryImages\Pages;

use App\Filament\Resources\AccessoryImages\AccessoryImageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccessoryImage extends EditRecord
{
    protected static string $resource = AccessoryImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
