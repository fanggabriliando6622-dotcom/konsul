<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;


class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('produkName')
                    ->label('Nama Produk')
                    ->required(),
                TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->prefix('Rp'),
                TextInput::make('qty')
                    ->numeric()
                    ->required(),

                DatePicker::make('Tanggal_Kadaluwarsa')
                    ->label('Tanggal Kadaluwarsa')
                    ->required(),

                FileUpload::make('gambar')
                    ->label('Gambar Produk')
                    ->acceptedFileTypes(['image/*'])
                    ->disk('public')
                    ->directory('images/produkALKES')
                    ->visibility('public')
                    ->fetchFileInformation(true)
                    ->previewable(false)
                    ->openable()
                    ->downloadable(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('kegunaan')
                    ->label('Kegunaan')
                    ->rows(3)
                    ->columnSpanFull(),
                TextInput::make('dosis')
                    ->label('Dosis')
                    ->maxLength(500),
                Textarea::make('efek_samping')
                    ->label('Efek Samping')
                    ->rows(3)
                    ->columnSpanFull(),

                Select::make('kategoriId')
                    ->label('Kategori')
                    ->options(fn () => DB::table('kategoriALKES')->pluck('kategoriName', 'kategoriId'))
                    ->required()
                    ->searchable(),
                Select::make('adminId')
                    ->label('Admin')
                    ->options(fn () => DB::table('admin')->pluck('name', 'adminId'))

                    ->required()
                    ->searchable(),
            ]);
    }
}