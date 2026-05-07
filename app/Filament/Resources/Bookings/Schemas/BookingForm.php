<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                TextInput::make('company_name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('address')
                    ->required()
                    ->rows(3),
                DatePicker::make('preferred_date_start')
                    ->required(),
                DatePicker::make('preferred_date_end')
                    ->required()
                    ->afterOrEqual('preferred_date_start'),
                TextInput::make('oven_interest')
                    ->required()
                    ->maxLength(255),
                TextInput::make('meals_per_day')
                    ->numeric()
                    ->required()
                    ->minValue(1),
                Select::make('status')
                    ->options([
                        'New' => 'New',
                        'Confirmed' => 'Confirmed',
                        'Completed' => 'Completed',
                        'Cancelled' => 'Cancelled',
                    ])
                    ->default('New')
                    ->required(),
                Textarea::make('notes')
                    ->rows(4),
            ]);
    }
}
