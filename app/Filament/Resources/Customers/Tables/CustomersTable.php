<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class CustomersTable {
    public static function configure(Table $table): Table {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),

                TextColumn::make('contact_no')
                    ->searchable(),

                TextColumn::make('whatsapp_no')
                    ->searchable(),

                // ✅ Country name
                TextColumn::make('country.name')
                    ->label('Country')
                    ->sortable()
                    ->searchable(),

                // ✅ State name
                TextColumn::make('state.name')
                    ->label('State')
                    ->sortable()
                    ->searchable(),

                // ✅ City name
                TextColumn::make('city.name')
                    ->label('City')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('zipcode')
                    ->sortable(),

                TextColumn::make('is_active')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? 'Active' : 'Inactive')
                    ->colors([
                        'success' => 1,
                        'danger' => 0,
                    ]),

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

                SelectFilter::make('country_id')
                    ->label('Country')
                    ->relationship('country', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('state_id')
                    ->label('State')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload(),

            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
