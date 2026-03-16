<?php

namespace App\Filament\Resources\Carts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CartForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customerId')
                    ->required(),
                TextInput::make('produkId')
                    ->default(null),
                TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }
}
