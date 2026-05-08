<?php

namespace App\Filament\Resources\PageResource\Schemas;

use App\Filament\Fields\GrapesJs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->regex('/^[a-z0-9\-]+$/')
                    ->unique('pages', 'slug', ignoreRecord: true),
                GrapesJs::make('content')
                    ->label('Page Content')
                    ->minHeight(700)
                    ->default('<h2 class="text-2xl font-bold text-gray-900">Welcome</h2><p class="text-base text-gray-700 leading-relaxed">Start editing your page content here. Drag blocks from the right panel to build your page.</p>')
                    ->columnSpanFull(),
                Textarea::make('meta_description')
                    ->label('Meta Description (SEO)')
                    ->rows(2)
                    ->maxLength(255)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->default(true),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
