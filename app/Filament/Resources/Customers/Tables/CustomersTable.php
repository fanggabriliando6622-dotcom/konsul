<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customerId')
                    ->searchable(),
                TextColumn::make('name')

                    ->searchable(),
                TextColumn::make('email')

                    ->searchable(),
                TextColumn::make('password')

                    ->searchable(),
                TextColumn::make('alamat')
                    ->searchable(),
                TextColumn::make('customerNoTelp')
                    ->searchable(),
                TextColumn::make('customerJenisKelamin')
                    ->badge(),
                \Filament\Tables\Columns\ImageColumn::make('avatar')
                    ->disk('public')
                    ->width(60)
                    ->height(60)
                    ->circular(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
