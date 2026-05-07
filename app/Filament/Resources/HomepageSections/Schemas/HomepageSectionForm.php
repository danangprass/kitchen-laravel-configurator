<?php

namespace App\Filament\Resources\HomepageSections\Schemas;

use Filament\Forms\Components\JsonEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HomepageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options([
                        'hero' => 'Hero Banner',
                        'product_slider' => 'Product Slider',
                        'line_showcase' => 'Line Showcase',
                        'cta_banner' => 'CTA Banner',
                        'value_props' => 'Value Propositions',
                        'blog_cards' => 'Blog Cards',
                        'newsletter' => 'Newsletter Signup',
                        'seo_text' => 'SEO Text Block',
                    ])
                    ->required()
                    ->live(),
                TextInput::make('title')
                    ->maxLength(255),
                TextInput::make('subtitle')
                    ->maxLength(255),
                Select::make('background_type')
                    ->options([
                        'none' => 'None',
                        'color' => 'Color',
                        'image' => 'Image',
                    ])
                    ->default('none')
                    ->live(),
                TextInput::make('background_data')
                    ->label('Background Value (hex color or image path)')
                    ->maxLength(255)
                    ->visible(fn ($get) => $get('background_type') !== 'none'),
                TextInput::make('cta_text')
                    ->label('CTA Button Text')
                    ->maxLength(255),
                TextInput::make('cta_url')
                    ->label('CTA Button URL')
                    ->maxLength(255),
                Select::make('product_ids')
                    ->label('Featured Products')
                    ->relationship('products', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->visible(fn ($get) => in_array($get('type'), ['product_slider', 'line_showcase'])),
                TextInput::make('line_family')
                    ->label('Line Family')
                    ->maxLength(255)
                    ->visible(fn ($get) => $get('type') === 'line_showcase'),
                JsonEditor::make('content')
                    ->label('Section Content (JSON)')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->default(true),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
