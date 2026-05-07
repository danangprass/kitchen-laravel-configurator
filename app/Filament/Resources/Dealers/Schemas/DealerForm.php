<?php

namespace App\Filament\Resources\Dealers\Schemas;

use App\Models\Dealer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DealerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->options(array_combine(Dealer::types(), Dealer::types()))
                    ->required(),
                Select::make('service_level')
                    ->options(array_combine(Dealer::serviceLevels(), Dealer::serviceLevels()))
                    ->required(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('latitude')
                    ->numeric()
                    ->step(0.0000001),
                TextInput::make('longitude')
                    ->numeric()
                    ->step(0.0000001),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('website')
                    ->url()
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
