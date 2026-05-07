<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('answer')
                    ->required()
                    ->columnSpanFull(),
                Select::make('category')
                    ->options([
                        'Products' => 'Products',
                        'Ordering' => 'Ordering',
                        'Shipping' => 'Shipping',
                        'Warranty' => 'Warranty',
                        'General' => 'General',
                    ])
                    ->required()
                    ->default('General'),
                Toggle::make('is_active')
                    ->default(true),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
