<?php

namespace App\Filament\Resources\AccessoryImages;

use App\Filament\Resources\AccessoryImages\Pages\CreateAccessoryImage;
use App\Filament\Resources\AccessoryImages\Pages\EditAccessoryImage;
use App\Filament\Resources\AccessoryImages\Pages\ListAccessoryImages;
use App\Filament\Resources\AccessoryImages\Schemas\AccessoryImageForm;
use App\Filament\Resources\AccessoryImages\Tables\AccessoryImagesTable;
use App\Models\AccessoryImage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AccessoryImageResource extends Resource
{
    protected static ?string $model = AccessoryImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return AccessoryImageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccessoryImagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAccessoryImages::route('/'),
            'create' => CreateAccessoryImage::route('/create'),
            'edit' => EditAccessoryImage::route('/{record}/edit'),
        ];
    }
}
