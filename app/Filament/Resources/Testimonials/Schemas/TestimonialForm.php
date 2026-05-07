<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('company')
                    ->maxLength(255),
                TextInput::make('industry')
                    ->maxLength(255),
                FileUpload::make('photo')
                    ->image()
                    ->directory('testimonials')
                    ->maxSize(2048),
                Textarea::make('quote')
                    ->required()
                    ->columnSpanFull()
                    ->rows(4),
                TextInput::make('video_url')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://www.youtube.com/watch?v=...'),
                Select::make('rating')
                    ->required()
                    ->options([
                        1 => '1 Star',
                        2 => '2 Stars',
                        3 => '3 Stars',
                        4 => '4 Stars',
                        5 => '5 Stars',
                    ])
                    ->default(5),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_featured')
                    ->helperText('Featured testimonials appear first on the frontend page.'),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }
}
