<?php

namespace App\Filament\Resources\AccessoryImages\Pages;

use App\Filament\Resources\AccessoryImages\AccessoryImageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccessoryImages extends ListRecords
{
    protected static string $resource = AccessoryImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
