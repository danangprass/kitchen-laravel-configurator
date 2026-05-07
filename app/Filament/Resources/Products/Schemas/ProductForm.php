<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('short_description')
                    ->columnSpanFull(),
                TextInput::make('video_url')
                    ->url()
                    ->helperText('YouTube or Vimeo embed URL')
                    ->placeholder('https://www.youtube.com/embed/...'),
                TextInput::make('type'),
                TextInput::make('panel'),
                TextInput::make('power_supply'),
                TextInput::make('width')
                    ->numeric(),
                TextInput::make('depth')
                    ->numeric(),
                TextInput::make('height')
                    ->numeric(),
                TextInput::make('weight')
                    ->numeric(),
                TextInput::make('number_of_trays')
                    ->numeric(),
                TextInput::make('tray_size'),
                TextInput::make('distance_between_trays')
                    ->numeric(),
                TextInput::make('voltage'),
                TextInput::make('electric_power')
                    ->numeric(),
                TextInput::make('frequency'),
                TextInput::make('consumption_kwh')
                    ->numeric(),
                TextInput::make('co2_emission')
                    ->numeric(),
                Toggle::make('energy_star_certified')
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('$'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
