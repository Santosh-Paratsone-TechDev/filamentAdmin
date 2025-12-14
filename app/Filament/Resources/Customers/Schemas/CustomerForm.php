<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Models\State;
use App\Models\City;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;


class CustomerForm {
    public static function configure(Schema $schema): Schema {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('contact_no')
                    ->required(),
                TextInput::make('whatsapp_no')
                    ->default(null),
                Textarea::make('profile_image')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('address')
                    ->default(null)
                    ->columnSpanFull(),
                // ✅ COUNTRY
                Select::make('country_id')
                    ->label('Country')
                    ->relationship('country', 'name')
                    ->searchable()
                    ->preload()
                    ->live() // 🔥 important
                    ->required(),

                // ✅ STATE (depends on country)
                Select::make('state_id')
                    ->label('State')
                    ->options(fn ($get) =>
                        $get('country_id')
                            ? State::where('country_id', $get('country_id'))
                                ->pluck('name', 'id')
                            : []
                    )
                    ->searchable()
                    ->live()
                    ->required()
                    ->disabled(fn ($get) => blank($get('country_id'))),

                // ✅ CITY (depends on state)
                Select::make('city_id')
                    ->label('City')
                    ->options(fn ($get) =>
                        $get('state_id')
                            ? City::where('state_id', $get('state_id'))
                                ->pluck('name', 'id')
                            : []
                    )
                    ->searchable()
                    ->required()
                    ->disabled(fn ($get) => blank($get('state_id'))),
                TextInput::make('zipcode')
                    ->numeric()
                    ->default(null),
                TextInput::make('is_active')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }
}
