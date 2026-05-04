<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name')->searchable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('sku')->label('SKU')->searchable(),
                TextColumn::make('accessories_count')
                    ->counts('accessories')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type')->searchable(),
                TextColumn::make('panel')->searchable(),
                TextColumn::make('power_supply')->searchable(),
                TextColumn::make('width')->numeric()->sortable(),
                TextColumn::make('depth')->numeric()->sortable(),
                TextColumn::make('height')->numeric()->sortable(),
                TextColumn::make('weight')->numeric()->sortable(),
                TextColumn::make('number_of_trays')->numeric()->sortable(),
                TextColumn::make('tray_size')->searchable(),
                TextColumn::make('distance_between_trays')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('voltage')->searchable(),
                TextColumn::make('electric_power')->numeric()->sortable(),
                TextColumn::make('frequency')->searchable(),
                TextColumn::make('consumption_kwh')->numeric()->sortable(),
                TextColumn::make('co2_emission')->numeric()->sortable(),
                IconColumn::make('energy_star_certified')->boolean(),
                TextColumn::make('price')->money()->sortable(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('sort_order')->numeric()->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
