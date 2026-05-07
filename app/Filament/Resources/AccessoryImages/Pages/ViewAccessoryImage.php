<?php

namespace App\Filament\Resources\AccessoryImages\Pages;

use App\Filament\Resources\AccessoryImages\AccessoryImageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAccessoryImage extends ViewRecord
{
    protected static string $resource = AccessoryImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
