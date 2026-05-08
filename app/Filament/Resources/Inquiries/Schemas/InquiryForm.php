<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contact Information')
                ->columns(2)
                ->schema([
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')->tel()->maxLength(255),
                    TextInput::make('company')->maxLength(255),
                    TextInput::make('country')->maxLength(255),
                    Select::make('category')
                        ->required()
                        ->options([
                            'Sales Support' => 'Sales Support',
                            'Service Support' => 'Service Support',
                            'Cooking Support' => 'Cooking Support',
                            'General Inquiry' => 'General Inquiry',
                        ]),
                ]),
            Section::make('Message')->schema([
                Textarea::make('message')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),
            ]),
            Section::make('Status')->schema([
                Toggle::make('is_read')->label('Mark as Read'),
            ]),
        ]);
    }
}
