<?php

namespace App\Filament\Resources\Dokters\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DoktersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('dokterId')
                    ->searchable(),
                TextColumn::make('dokterName')
                    ->searchable(),
                TextColumn::make('namaBidang')
                    ->searchable(),
                TextColumn::make('dokterAge')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jenisKelamin')
                    ->badge(),
                \Filament\Tables\Columns\ImageColumn::make('gambar')
                    ->disk('public')
                    ->width(60)
                    ->height(60),
                TextColumn::make('statusDokter')
                    ->badge(),
                TextColumn::make('jadwalPraktik')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('hargaKonsultasi')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('adminId')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
