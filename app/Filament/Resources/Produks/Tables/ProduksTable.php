<?php

namespace App\Filament\Resources\Produks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn; // ✅ tambah import ini
use Filament\Tables\Table;


class ProduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('produkId')
                    ->searchable(),
                TextColumn::make('produkName')
                    ->searchable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('qty')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('gambar')
                    ->disk('public')        // ✅ ambil dari storage/app/public
                    ->width(60)
                    ->height(60),           // ✅ hapus ->directory(), path sudah tersimpan lengkap di DB
                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kegunaan')
                    ->label('Kegunaan')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('dosis')
                    ->label('Dosis')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('efek_samping')
                    ->label('Efek Samping')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('Tanggal_Kadaluwarsa')
                    ->label('Tgl Kadaluwarsa')
                    ->date()
                    ->sortable(),
                TextColumn::make('kategoriId')
                    ->searchable(),
                TextColumn::make('adminId')
                    ->searchable(),
            ])
            ->filters([])
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